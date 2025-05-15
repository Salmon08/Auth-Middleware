<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\RedirectIfLoggedin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->middleware('guest.session')->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(CheckLogin::class);

// Route to display the create user form (for testing or seeding purpose, not secured with middleware)
Route::get('/create-user', [AuthController::class, 'createUser']);
