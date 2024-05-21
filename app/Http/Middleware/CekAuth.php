<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rules): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $user = Auth::user();
        if ($user->role_id == $rules) {
            return $next($request);
        }
        return redirect('login')->with('error',"kamu gak punya akses");
    }
}
