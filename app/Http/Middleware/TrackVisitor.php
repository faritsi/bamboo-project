<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\visitor;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        if (!\App\Models\Visitor::where('ip_address', $ipAddress)
                                ->whereDate('created_at', today())->exists()) {
            \App\Models\Visitor::create(['ip_address' => $ipAddress]);
        }
        return $next($request);
    }
}
