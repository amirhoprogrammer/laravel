<?php
use App\Http\Controllers\ChripController;
use App\Http\Controllers\ChriperController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home');
//});
//Route::get('/', [ChripController::class , 'index']);
Route::get('/', [ChriperController::class , 'index']);