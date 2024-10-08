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
            return redirect()->intended('/home');
        }
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }
    public function proses(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);
        
        $kredensial = $request->only('username', 'password');
        if(Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if($user){
                return redirect()->intended('/home');
            }
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'username salah',
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
