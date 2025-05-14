<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()             //index
    {
        return view('login');
    }

    public function login(Request $request)         //store
    {
         $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        session(['user' => $user]);
        return redirect('/dashboard');
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);

    }

    public function logout(Request $request)                //destroy
    {
        session()->flush();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Create a test user
    public function createUser()            //create
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        return 'Test user created!';
    }
}

