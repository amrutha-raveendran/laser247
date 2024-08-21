<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Log;
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
       // Fetch data from the API
    $response = Http::get('https://api.datalaser247.com/api/guest/events');
    $events = $response->json('data.events');
    $data = $response->json();
    // Mock data for sidebar (replace this with actual API call if needed)
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

    // Prepare events grouped by event_type_id
    $groupedEvents = [];
    foreach ($events as $event) {
        $eventTypeId = $event['event_type_id'];
        if (!isset($groupedEvents[$eventTypeId])) {
            $groupedEvents[$eventTypeId] = [];
        }
        $groupedEvents[$eventTypeId][] = $event;
    }
    $groupedEvents = collect($groupedEvents);
    $sidebarEvents = collect($data['data']['events'])->groupBy(['event_type_id', 'competition_name']);
    return view('events', compact('menuData', 'groupedEvents','sidebarEvents'));
    }
 
    public function getEventDetails($eventId)
    {
        $responseDetail = $this->httpClient->request('POST', "https://api.datalaser247.com/api/guest/event/{$eventId}");
    
        // Decode the JSON response
        $responseBody = $responseDetail->getBody();
        $eventDetails = json_decode($responseBody, true);
        //dd($eventDetails);
        $url = 'https://odds.cricbet99.club/ws/getScoreData';
    
        // Initialize cURL session
        $ch = curl_init();
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'event_id' => $eventId,
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
        ]);
    
        // Execute the cURL request
        $response = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            curl_close($ch);
            abort(500, 'cURL Error: ' . curl_error($ch));
        }
    
        // Get the HTTP status code
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        // Close the cURL session
        curl_close($ch);
       
        if ($httpStatusCode === 204) {
            return view('event_details', [
                'message' => 'No content available for this event.'
            ]);
        }

        // Return the raw HTML response directly to the Blade view
        return view('event_details', [
            'htmlContent' => $response
        ]);
    }
}
