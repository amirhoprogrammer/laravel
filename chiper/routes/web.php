<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ChirperController;

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home');
//});
//Route::get('/', [ChirpController::class , 'index']);
Route::get('/', [ChirperController::class , 'index']);
Route::post('/chirps', [ChirperController::class, 'store']);
Route::get('/chirps/{chirp}/edit', [ChirperController::class, 'edit']);
Route::put('/chirps/{chirp}/', [ChirperController::class, 'update']);
Route::delete('/chirps/{chirp}/', [ChirperController::class, 'delete']);

Route::resource('/chirps', ChirperController::class)
    ->only(['store', 'edit', 'update', 'destroy']);