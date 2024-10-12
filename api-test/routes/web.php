<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ApiController::class, 'home'])->name('home');
Route::get('/event', [ApiController::class, 'event'])->name('event');
Route::get('/event1', [ApiController::class, 'event1'])->name('event1');
Route::get('/event/{id}', [ApiController::class, 'eventDetail'])->name('eventDetail');
Route::get('/event/{id}/details', [ApiController::class, 'fetchEventDetails']);
Route::get('/event/{id}/score', [ApiController::class, 'fetchScoreData']);
// Route::post('/pusher/webhook', [ApiController::class, 'handleWebhook']);
