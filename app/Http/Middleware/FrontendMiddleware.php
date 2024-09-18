<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class FrontendMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user(); // Retrieve the authenticated user

            // Check if the authenticated user is a customer
            if ($user && $user->isCustomer()) {
                return $next($request); // Allow access to the route
            }
        }

        // If the user is not authenticated or not a customer, redirect to the home page with an error message
        return redirect('/')->withErrors(['error' => 'Unauthorized: Only customers can access this section']);
    }
}
