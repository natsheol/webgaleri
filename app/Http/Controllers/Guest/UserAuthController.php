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
    /** ============================
     *  SHOW LOGIN FORM
     * ============================ */
    public function showLoginForm(Request $request)
    {
        // Ambil redirect_to dari query string
        $redirectTo = $request->query('redirect_to', '');

        return view('guest.auth.login', compact('redirectTo'));
    }

    /** ============================
     *  HANDLE LOGIN
     * ============================ */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth('web')->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            // Ambil redirect_to dari input hidden form
            $redirectUrl = $request->input('redirect_to');

            if ($redirectUrl && str_starts_with($redirectUrl, '/')) {
                return redirect($redirectUrl);
            }

            return redirect()->route('guest.home'); 
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    /** ============================
     *  SHOW REGISTER FORM
     * ============================ */
    public function showRegisterForm()
    {
        return view('guest.auth.register');
    }

    /** ============================
     *  HANDLE REGISTER
     * ============================ */
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

    /** ============================
     *  LOGOUT
     * ============================ */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest.home')->with('success', 'You have been logged out successfully.');
    }
}
