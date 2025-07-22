<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->role === 2 || Auth::guest()) {
            // Allow regular users (role 2) and guests to access
            return $next($request);
        }

        // For admin users (role 1), redirect to admin dashboard
        if (auth()->user()?->role === 1) {
            return redirect()->route('admin.dashboard');
        }
        
        // For partner users (role 3), redirect to partner dashboard
        if (auth()->user()?->role === 3) {
            return redirect()->route('partner.dashboard');
        }
        
        // Default fallback for any other roles
        return redirect()->route('admin.login');
    }
}
