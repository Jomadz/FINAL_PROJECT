<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated and has the correct role
        if (Auth::check()) {
            if (Auth::user()->role === $role) {
                return $next($request);
            }

            // Redirect users to the correct dashboard
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard'); // Ensure this route exists
            } else {
                return redirect()->route('seller.dashboard'); // Ensure this route exists
            }
        }

        // Redirect if not authenticated
        return redirect()->route('welcome');
    }
}
