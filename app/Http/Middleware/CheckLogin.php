<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('CheckLogin middleware is running');   // Debug line to check if middleware is triggered

        if (!session('user'))                       // Check if 'user' is not present in the session
        {
            return redirect('/login')->withErrors('You must be logged in.'); // Redirect to login with error
        }

        return $next($request);                     // Allow the request to proceed if user is logged in
    }
}
