<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function showEvents()
    {
        // Mock data, replace with your actual data source
        $data = [
            "events" => [
                [
                    "event_id" => 33484486,
                    "name" => "ATP Cincinnati 2024",
                    "category" => "0",
                    "provider" => 0,
                    "competition_id" => 12678735,
                    "event_type_id" => 4,
                    "open_date" => "2024-08-09 00:00:00",
                    "bet_allow" => 1,
                    "in_play" => 0,
                    "tv_channel" => null,
                    "bm_active" => 1,
                    "fancy_active" => 0,
                    "custom_active" => "",
                    "featured_event" => 0,
                    "shortcut_event" => 0,
                    "market_id" => "1.231690431",
                    "id" => 12678735,
                    "competition_name" => "ATP Cincinnati 2024",
                    "open_date_format" => "2024-08-09T00:00:00.000000Z"
                ],
                // Add more events if needed
            ]
        ];

        // Filter events based on category and event_type_id
        $filteredEvents = collect($data['events'])->filter(function ($event) {
            return $event['category'] == 0 && $event['event_type_id'] == 4;
        });

        return view('events', ['events' => $filteredEvents]);
    }
}
