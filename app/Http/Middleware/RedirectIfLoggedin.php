<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLoggedin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('user'))             // If user is already logged in (session has 'user')
        {
            return redirect('/dashboard');      // Redirect to dashboard to prevent accessing login page again
        }

        return $next($request);                 // Allow the request to proceed if not logged in
    }
}
