<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ChirperController;

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home');
//});
//Route::get('/', [ChirpController::class , 'index']);
Route::get('/', [ChirperController::class , 'index']);
Route::middleware('auth')->group(function () {
    Route::post('/chirps', [ChirperController::class, 'store']);
    Route::get('/chirps/{chirp}/edit', [ChirperController::class, 'edit']);
    Route::put('/chirps/{chirp}', [ChirperController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirperController::class, 'destroy']);
});

// Registration routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

//Route::post('/register', Register::class)
//    ->middleware('guest');

Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');

//login
Route::view('/login', "auth.login")
    ->middleware('guest')
    ->name('login');
Route::post('login', Login::class)
    ->middleware('guest');
//Route::resource('/chirps', ChirperController::class)
//    ->only(['store', 'edit', 'update', 'destroy']);