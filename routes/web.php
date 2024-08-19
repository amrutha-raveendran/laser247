<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();
use App\Http\Controllers\EventController;

Route::get('/events', [EventController::class, 'showEvents']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
