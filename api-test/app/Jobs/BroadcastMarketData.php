<?php

namespace App\Jobs;

use App\Events\EventMarket;
use App\Services\EventService;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BroadcastMarketData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $eventId;
    protected $eventService;
    // protected $dispatchCount;
    // protected $maxDispatches = 5; // Set your limit here

    /**
     * Create a new job instance.
     */
    public function __construct($eventId, EventService $eventService)   //, $dispatchCount
    {
        $this->eventId = $eventId;
        // Log::info('Event ID in BroadcastMarketData: ' . $this->eventId);
        $this->eventService = $eventService;
        // $this->dispatchCount = $dispatchCount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $eventData = $this->eventService->fetchEventData($this->eventId);
        $eventDetails = $eventData['data']['event'] ?? null;
        $marketIds = $this->eventService->extractMarketIds($eventDetails);
        // Rotate market_ids
        if (count($marketIds) > 1) {
            $lastElement = array_pop($marketIds);
            array_unshift($marketIds, $lastElement);
        }

        $marketDataResponse = $this->eventService->fetchMarketData($marketIds);
        if (!$eventData || !$eventDetails || empty($marketIds) || !$marketDataResponse) {
            Log::error('Error fetching event or market data for event ID: ' . $this->eventId);
            return;
        }

        // Adjust the interval as needed
        broadcast(new EventMarket($eventDetails['event'], $marketDataResponse['items'], $eventDetails));

        // self::dispatch($this->eventId, $this->eventService)->delay(now()->addSeconds(2));

        // // Check if we can dispatch again
        // if ($this->dispatchCount < $this->maxDispatches) {
        //     self::dispatch($this->eventId, $this->eventService, $this->dispatchCount + 1)
        //         ->delay(now()->addSeconds(2));
        // } else {
        //     Log::info('Max dispatch limit reached for event ID: ' . $this->eventId);
        // }
        //->delay(now()->addSeconds(2));



    }
}
