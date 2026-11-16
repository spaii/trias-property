<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/kalkulator', [PropertyController::class, 'index'])
    ->name('home');
Route::post('/calculate', [PropertyController::class, 'calculate'])
    ->name('calculate');
Route::post('/simulate', [PropertyController::class, 'simulate'])
    ->name('simulate');
Route::post('/order', [PropertyController::class, 'storeOrder'])
    ->name('order.store');
