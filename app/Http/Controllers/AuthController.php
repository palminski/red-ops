<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function showSignupForm() {
        return view('auth.signup');
    }

    public function login(Request $request) {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'username' => "The provided info doesn't match records"
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
