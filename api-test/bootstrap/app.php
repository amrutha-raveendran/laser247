<?php

use App\Console\Commands\BroadcastMarketDataCommand;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withcommands([
        BroadcastMarketDataCommand::class,
    ])
    // ->withCommands([__DIR__ . '/../app/Console/Commands',])
    // ->withCommands([
    //     __DIR__ .  '/../routes/console.php',
    //     __DIR__ .  '/../app/Console/Commands/broadcast:market-data {eventId}',
    // ])
    ->create();
