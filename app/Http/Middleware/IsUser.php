<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        // Log the middleware execution to help diagnose issues
        Log::info('IsUser middleware executing', [
            'path' => $request->path(),
            'is_authenticated' => Auth::check(),
            'role' => auth()->user()?->role ?? 'guest'
        ]);
        
        try {
            // CRITICAL FIX: If this is the home page and we're getting redirect loops,
            // allow access regardless of role to break the loop
            if ($request->is('/')) {
                Log::info('Home page access, allowing access to prevent redirect loops');
                return $next($request);
            }
            
            // Prevent redirect loops by checking if we're already being redirected
            if ($request->is('admin/dashboard') || $request->is('partner/dashboard') || $request->is('admin/login')) {
                Log::info('Already on a dashboard/login page, allowing access');
                return $next($request);
            }
            
            // Allow regular users (role 2) and guests to access
            // Use loose comparison (==) instead of strict (===) to handle string/integer type differences
            if (auth()->user()?->role == 2 || Auth::guest()) {
                Log::info('Regular user or guest, allowing access');
                return $next($request);
            }

            // For admin users (role 1), redirect to admin dashboard
            // Use loose comparison (==) for consistency with string/integer types
            if (auth()->user()?->role == 1) {
                Log::info('Admin user, redirecting to admin dashboard');
                return redirect()->route('admin.dashboard');
            }
            
            // For partner users (role 3), redirect to partner dashboard
            // Use loose comparison (==) for consistency with string/integer types
            if (auth()->user()?->role == 3) {
                Log::info('Partner user, redirecting to partner dashboard');
                return redirect()->route('partner.dashboard');
            }
            
            // Default fallback for any other roles - just allow access rather than redirecting
            // This prevents redirect loops in case of unexpected role values
            Log::info('Unknown role, allowing access to prevent redirect loops');
            return $next($request);
        } catch (\Exception $e) {
            // If any error occurs, log it and allow access to prevent redirect loops
            Log::error('Error in IsUser middleware', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $next($request);
        }
    }
}
