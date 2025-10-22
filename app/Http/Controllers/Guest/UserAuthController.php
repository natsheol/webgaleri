<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('guest.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Update last login time
            Auth::guard('web')->user()->update(['last_login_at' => now()]);
            
            // Check if user is banned
            if (Auth::guard('web')->user()->status === 'banned') {
                Auth::guard('web')->logout();
                return back()->withErrors(['email' => 'Your account has been banned.']);
            }
            
            return redirect()->intended(route('guest.home'))->with('success', 'Welcome back, ' . Auth::guard('web')->user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Show register form
    public function showRegisterForm()
    {
        return view('guest.auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('guest.home')->with('success', 'Welcome to Hogwarts, ' . $user->name . '!');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest.home')->with('success', 'You have been logged out successfully.');
    }

    // Show user profile
    public function profile()
    {
        $user = Auth::guard('web')->user();

        // Get liked facility photos
        $likedPhotos = $user->facilityPhotoLikes()
            ->with('photo.category')
            ->latest()
            ->get();

        // Get all comments from all sources
        $facilityComments = $user->facilityPhotoComments()
            ->with('photo')
            ->latest()
            ->get();

        $prophetComments = $user->hogwartsProphetComments()
            ->with('article')
            ->latest()
            ->get();

        $achievementComments = $user->achievementComments()
            ->with('achievement')
            ->latest()
            ->get();

        // Merge and sort all comments by date
        $allComments = collect()
            ->merge($facilityComments->map(function($comment) {
                return [
                    'id' => $comment->id,
                    'type' => 'facility',
                    'content' => $comment->content,
                    'item_name' => $comment->photo->name ?? 'Deleted Photo',
                    'created_at' => $comment->created_at,
                    'is_approved' => $comment->is_approved,
                ];
            }))
            ->merge($prophetComments->map(function($comment) {
                return [
                    'id' => $comment->id,
                    'type' => 'prophet',
                    'content' => $comment->content,
                    'item_name' => $comment->article->title ?? 'Deleted Article',
                    'created_at' => $comment->created_at,
                    'is_approved' => $comment->is_approved,
                ];
            }))
            ->merge($achievementComments->map(function($comment) {
                return [
                    'id' => $comment->id,
                    'type' => 'achievement',
                    'content' => $comment->content,
                    'item_name' => $comment->achievement->title ?? 'Deleted Achievement',
                    'created_at' => $comment->created_at,
                    'is_approved' => $comment->is_approved,
                ];
            }))
            ->sortByDesc('created_at')
            ->values();

        return view('guest.auth.profile', compact('likedPhotos', 'allComments'));
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('web')->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path('storage/' . $user->avatar))) {
                unlink(public_path('storage/' . $user->avatar));
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    // Change password
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = Auth::guard('web')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
