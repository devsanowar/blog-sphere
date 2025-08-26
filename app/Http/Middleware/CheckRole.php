<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the logged-in user has the correct role
        if (Auth::check()) {
            if ($role == 'super-admin' && Auth::user()->system_admin != 1) {
                return redirect()->route('dashboard'); // Redirect non-Super Admins
            }

            if ($role == 'admin' && Auth::user()->system_admin == 1) {
                return redirect()->route('admin.dashboard'); // Redirect Super Admins
            }
        }

        return $next($request);
    }
}
