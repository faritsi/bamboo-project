<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        $ingpo = Ingpo::all();

        if (Auth::user()) {
            return redirect()->intended('/home');
        }
        return view('auth.login', [
            'title' => 'Login'
        ], compact('ingpo'));
    }
    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $kredensial = $request->only('username', 'password');
        $user = User::where('username', $request->username)->first();

        // Check if username exists
        if (!$user) {
            return back()->withErrors([
                'username' => 'Username Salah',
            ])->withInput(['username']);
        }

        // Check if password is correct
        if (!Auth::attempt($kredensial)) {
            return back()->withErrors([
                'password' => 'Password Salah',
            ])->withInput(['username']);
        }

        // Authentication successful
        $request->session()->regenerate();

        // Redirect user based on intended URL or default route
        return redirect()->intended('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
