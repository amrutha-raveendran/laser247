<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Collection;
use Log;
class EventController extends Controller
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
        $this->CommonController = new CommonController();
        // $this->middleware('auth');
    }

    public function showDashboard()
    {
        
       // Fetch data from the API
    $response = Http::get('https://api.datalaser247.com/api/guest/events');
    $events = $response->json('data.events');
    $data = $response->json();
    // Mock data for sidebar (replace this with actual API call if needed)

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
   

      return view('events', ['menuData' => $this->CommonController->list_menu(), 'groupedEvents' => $groupedEvents,'sidebarEvents'=>$this->CommonController->sidebar(),'menus'=>$this->CommonController->header_menus()]);
    }
 
    public function getEventDetails($eventId)
    {
        // Fetch event details from the first API
        $responseDetail = $this->httpClient->request('POST', "https://api.datalaser247.com/api/guest/event/{$eventId}");
        $eventDetails = json_decode($responseDetail->getBody()->getContents(), true);
    
        // Extract the market_id from event details
        $marketId = $eventDetails['data']['event']['match_odds']['market_id'];
    
        // Make a POST request to get market data from the second API
        $responseMarketData = $this->httpClient->request('POST', 'https://odds.laser247.online/ws/getMarketDataNew', [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'market_ids[]' => $marketId,
            ],
        ]);
    
        // Get the market data as a string
        $marketDataString = trim($responseMarketData->getBody()->getContents());
    
        // Split the string into an array using the '|' delimiter
        $marketDataArray = explode('|', $marketDataString);
    
        // Initialize arrays to hold the rows of data
        $rows = [];
        $currentOdds = [];
        $currentValues = [];
    
        // Process the array to extract odds and values
        $isActiveSection = false;
        foreach ($marketDataArray as $data) {
            if ($data === 'ACTIVE') {
                // If we've already encountered an active section, push the current data to rows
                if ($isActiveSection) {
                    $rows[] = ['odds' => $currentOdds, 'values' => $currentValues];
                    $currentOdds = [];
                    $currentValues = [];
                }
                // Now start a new active section
                $isActiveSection = true;
            } elseif ($isActiveSection) {
                if (is_numeric($data)) {
                    if (count($currentOdds) === count($currentValues)) {
                        $currentOdds[] = $data;
                    } else {
                        $currentValues[] = $data;
                    }
                }
            }
        }
    
        // Add the last set of odds and values if available
        if (!empty($currentOdds) && !empty($currentValues)) {
            $rows[] = ['odds' => $currentOdds, 'values' => $currentValues];
        }
    
        // Initialize cURL session for the additional request
        $url = 'https://odds.cricbet99.club/ws/getScoreData';
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
    
        // Return the combined data to the Blade view
        return view('event_details', [
            'htmlContent' => $response,
            'eventDetails' => $eventDetails['data']['event'],
            'rows' => $rows,
            'menuData' => $this->CommonController->list_menu(),
            'sidebarEvents' => $this->CommonController->sidebar(),
            'menus' => $this->CommonController->header_menus(),
        ]);
    }
    

    
}
