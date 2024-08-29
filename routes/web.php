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

// Route to show the In-Play events page
Route::get('/inplay', [EventController::class, 'showInPlayEvents'])->name('events.inplay');

// Route to fetch In-Play events data for AJAX requests
Route::get('/inplay-events', [EventController::class, 'fetchInPlayEvents'])->name('inplay.events');

