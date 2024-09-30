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

Route::get('/eventtest/{eventId}', [EventController::class, 'getEventDetailsTest'])->name('event.details_test');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/fetch-market-data', [MarketDataController::class, 'getMarketData']);

// Route to show the In-Play events page
Route::get('/inplay', [EventController::class, 'showInPlayEvents'])->name('events.inplay');
Route::get('/sports/{sportId}', [EventController::class, 'showSports'])->name('events.sports');


// Route to fetch In-Play events data for AJAX requests
Route::get('/inplay-events', [EventController::class, 'fetchInPlayEvents'])->name('inplay.events');

