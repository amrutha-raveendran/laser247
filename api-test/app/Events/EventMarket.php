<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventMarket implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $event;
    public $items;
    public $eventDetails;
    public $marketIds;

    public function __construct($event, $items, $eventDetails, $marketIds)
    {
        $this->event = $event;
        $this->items = $items;
        $this->eventDetails = $eventDetails;
        $this->marketIds = $marketIds;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('event_Handle.' . $this->event['id']),
        ];
    }


    public function broadcastWith(): array
    {
        $data = [
            'event' => $this->event,
            'items' => $this->items,
            'eventDetails' => $this->eventDetails,
            'marketIds' => $this->marketIds,

        ];
        $jsonData = json_encode($data);
        $compressedData = base64_encode(gzcompress($jsonData));
        // return [
        //     'event' => $this->event,
        //     'items' => $this->items,
        //     'eventDetails' => $this->eventDetails,
        //     'marketIds' => $this->marketIds,
        // ];
        return ['data' => $compressedData];
    }

    public function broadcastAs()
    {
        // Event name for Pusher
        return 'event.pushed';
    }
}
