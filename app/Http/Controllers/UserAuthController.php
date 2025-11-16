<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    // tampilkan form login user biasa
    public function showLoginForm(Request $request)
    {
        return view('user.login', [
            'redirect' => $request->query('redirect')
        ]);
    }

    // proses login user biasa
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // ambil redirect target kalau ada
            $redirectUrl = $request->input('redirect');
            return redirect()->intended($redirectUrl ?? route('home'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}
