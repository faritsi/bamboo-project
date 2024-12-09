<?php

namespace App\Http\Controllers;

use App\Models\Ingpo;
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
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]
        );

        $kredensial = $request->only('username', 'password');
        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user) {
                return redirect()->intended('/home');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Username atau Password Salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
