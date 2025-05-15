<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()                 // index — Show the login form view
    {
        return view('login');
    }


    public function login(Request $request)         // store — Handle login and authentication
    {
        $user = User::where('email', $request->email)->first();         // Find user by email

        if ($user && Hash::check($request->password, $user->password)) // Check if password is correct
        {
            session(['user' => $user]);             // Store user in session
            return redirect('/dashboard');          // Redirect to dashboard if authenticated
        }

        return back()->withErrors(['email' => 'Invalid credentials.']); // If login fails, show error
    }


    public function logout(Request $request)        // destroy — Log out the user
    {
        session()->flush();                         // Clear all session data

        $request->session()->invalidate();          // Invalidate the session
        $request->session()->regenerateToken();     // Regenerate CSRF token

        return redirect('/login');                  // Redirect to login page
    }


    public function createUser()                    // create — Create a test user (for development/testing)
    {
        User::create([
            'name' => 'Test User',                  // Name of the test user
            'email' => 'test@example.com',          // Email of the test user
            'password' => Hash::make('password'),   // Hashed password
        ]);

        return 'Test user created!';                // Return confirmation message
    }
}
