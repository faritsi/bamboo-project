<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(){
        if (Auth::user()) {
            return redirect()->intended('/dashboard-admin');
        }
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }
    public function proses(Request $request)
    {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]);
        
        $kredensial = $request->only('email', 'password');
        if(Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if($user){
                return redirect()->intended('/dashboard-admin');
            }
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
