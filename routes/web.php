<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;


Route::get('/', function () {
    return view('welcome');
});


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware('auth');

// Route::middleware(CheckLogin::class)->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     });
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(CheckLogin::class);

Route::get('/create-user', [AuthController::class, 'createUser']);
