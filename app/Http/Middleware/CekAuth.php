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
    // public function handle(Request $request, Closure $next, $rules): Response
    // {
    //     if (!Auth::check()) {
    //         return redirect('login');
    //     }
    //     $user = Auth::user();
    //     if ($user->role_id == $rules) {
    //         return $next($request);
    //     }
    //     return redirect('login')->with('error',"kamu gak punya akses");
    // }
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Cek jika role_id user ada di dalam array roles yang diizinkan
        if (in_array($user->role_id, $roles)) {
            return $next($request);
        }

        return redirect('login')->with('error', "Kamu tidak memiliki akses.");
    }
}
