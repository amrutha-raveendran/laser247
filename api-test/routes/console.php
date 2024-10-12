<?php

use App\Jobs\BroadcastMarketData;
use App\Services\EventService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Schedule::command('broadcast:market-data', [$eventID])->everySecond();

// Schedule::command('broadcast:market-data', [$eventId])->everyFiveSeconds();

//Schedule::command('broadcast:market-data {eventId=' .$eventID.'}')->everySecond(); // Example scheduling for a specific interval


//Schedule::job(new BroadcastMarketData($eventID, app(\App\Services\EventService::class)))->everySecond();

// Schedule::job(new BroadcastMarketData($eventID, app(\App\Services\EventService::class)))->everySecond();
