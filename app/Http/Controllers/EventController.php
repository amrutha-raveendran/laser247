<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class EventController extends Controller
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
        // $this->middleware('auth');
    }

    public function showDashboard()
    {
        // Mock data for sidebar (replace with actual API call if needed)
        $menuData = [
            ["id" => 4, "name" => "Cricket"],
            ["id" => 1, "name" => "Football"],
            ["id" => 2, "name" => "Tennis"],
            ["id" => 99999, "name" => "Casino"],
            ["id" => 99995, "name" => "I Casino"],
            ["id" => 7, "name" => "Horse Racing"],
            ["id" => 4339, "name" => "Greyhound Racing"],
            ["id" => 99994, "name" => "Kabaddi"],
            ["id" => 2378961, "name" => "Politics"],
            ["id" => 99991, "name" => "Sports book"],
            ["id" => 99998, "name" => "Int Casino"],
            ["id" => 99990, "name" => "Binary"],
            ["id" => 99997, "name" => "Casino Vivo"],
            ["id" => 26420387, "name" => "Mixed Martial Arts"],
            ["id" => 998917, "name" => "Volleyball"],
            ["id" => 7524, "name" => "Ice Hockey"],
            ["id" => 7522, "name" => "Basketball"],
            ["id" => 7511, "name" => "Baseball"],
            ["id" => 3503, "name" => "Darts"],
            ["id" => 29, "name" => "Futsal"],
            ["id" => 20, "name" => "Table Tennis"],
            ["id" => 5, "name" => "Rugby"]
        ];

       // Fetch event list data from the API
       $response = Http::get('https://api.datalaser247.com/api/guest/event_list');
       $data = $response->json();

       // Group events by event_type_id and then by competition_name
       $groupedEvents = collect($data['data']['events'])->groupBy(['event_type_id', 'competition_name']);

       return view('events', ['menu' => $menuData, 'groupedEvents' => $groupedEvents]);
    }
    public function getEventDetails($eventId)
    {
        $response = $this->httpClient->request('POST', "https://api.datalaser247.com/api/guest/event/{$eventId}");
    
        // Decode the JSON response
        $responseBody = $response->getBody();
        $eventDetails = json_decode($responseBody, true);
    
        // Check if decoding was successful
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON parsing error
            abort(500, 'Failed to parse response');
        }
    
        // Extract data
        $event = $eventDetails['data']['event'];
        $matchOdds = $event['match_odds'];
        $overUnderGoals = array_filter($event['markets'], function($market) {
            return $market['market_type_id'] === 'OVER_UNDER_25';
        });
    
        return view('event_details', [
            'event' => $event['event'],
            'matchOdds' => $matchOdds,
            'overUnderGoals' => $overUnderGoals
        ]);
    }
    
    
}
