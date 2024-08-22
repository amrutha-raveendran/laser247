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
            'htmlContent' => $response, 'event_details'=>$eventDetails,'menuData' => $this->CommonController->list_menu(),'sidebarEvents'=>$this->CommonController->sidebar(),'menus'=>$this->CommonController->header_menus()
        ]);
    }
}
