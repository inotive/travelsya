<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsPartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('User attempting partner access: ' . auth()->user()?->email . ' with role: ' . auth()->user()?->role . ' (type: ' . gettype(auth()->user()?->role) . ')');

        // Changed from strict comparison (===) to loose comparison (==) to match the controller
        if (auth()->user()?->role == 1) {
            return $next($request);
        }

        abort(403);
    }
}
