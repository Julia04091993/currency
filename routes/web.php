<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use Illuminate\Http\Request;


Route::get('/', function (Request $request) {
    $request->session()->forget('key');
    return view('auth');
})->name('home');
Route::post('/', [AuthController::class, 'submit'])->name('auth-form');
Route::get('/currency', [CurrencyController::class, 'check']);
Route::post('/currency', [CurrencyController::class, 'get_curs'])->name('get-form');

