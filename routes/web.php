<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();
use App\Http\Controllers\EventController;
use App\Http\Controllers\MarketDataController;

Route::get('/dashboard', [EventController::class, 'showDashboard'])->name('dashboard');


Route::get('/event/{eventId}', [EventController::class, 'getEventDetails'])->name('event.details');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('events', [EventController::class, 'testfunction'])->name('events');

Route::post('/fetch-market-data', [MarketDataController::class, 'getMarketData']);

Route::get('/inplay', [EventController::class, 'showInPlayEvents'])->name('events.inplay');
Route::get('/sports/{sportId}', [EventController::class, 'showSports'])->name('events.sports');


