<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('User attempting admin access: ' . auth()->user()?->email . ' with role: ' . auth()->user()?->role . ' (type: ' . gettype(auth()->user()?->role) . ')');

        $user = Auth::user();

        // Use loose comparison (==) instead of strict (===) to handle string/integer type differences
        if ($user->role == 0) {
            return $next($request);
        }
        abort(403);
    }
}
