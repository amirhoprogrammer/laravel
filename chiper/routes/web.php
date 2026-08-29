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