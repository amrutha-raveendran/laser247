<?php

// app/Console/Commands/BroadcastMarketDataCommand.php

namespace App\Console\Commands;

use App\Jobs\BroadcastMarketData;
use App\Services\EventService;
use Illuminate\Console\Command;

class BroadcastMarketDataCommand extends Command
{
    protected $signature = 'broadcast:market-data {eventId}'; // Command signature
    protected $description = 'Broadcast market data for a specific event ID'; // Command description

    protected $eventService;

    public function __construct(EventService $eventService)
    {
        parent::__construct();
        $this->eventService = $eventService; // Inject the EventService
    }

    public function handle()
    {
        $eventId = $this->argument('eventId'); // Get the event ID from the command argument
        BroadcastMarketData::dispatch($eventId, $this->eventService); // Dispatch the job
        $this->info("Market data broadcasted for event ID: {$eventId}"); // Inform the user
    }
}
