<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use App\Helpers\CustomHelper;
use Log;

class EventController extends Controller
{
    protected $httpClient;
    protected $commonController;

    public function __construct()
    {
        $this->httpClient = new Client();
        $this->commonController = new CommonController();
        // $this->middleware('auth');
    }

    public function showDashboard()
    {
        $events = $this->fetchEvents();
        $groupedEvents = $this->groupEventsByType($events);

        return view('events', [
            'menuData' => $this->commonController->list_menu(),
            'groupedEvents' => $groupedEvents,
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus()
        ]);
    }

    public function getEventDetails($eventId)
    {
        $eventDetails = $this->fetchEventDetails($eventId);
        $marketIds = $this->extractMarketIds($eventDetails['data']['event']);
        $marketData = $this->fetchMarketData($marketIds);
        $scoreData = $this->fetchScoreData($eventId);

        $message = $this->handleNoContentResponse($scoreData['status']);

        return view('event_details', [
            'htmlContent' => $scoreData['content'],
            'eventDetails' => $eventDetails['data']['event'],
            'event_details' => $eventDetails,
            'rows' => $marketData['rows'],
            'message' => $message,
            'menuData' => $this->commonController->list_menu(),
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus(),
        ]);
    }

    private function fetchEvents()
    {
        $response = Http::get('https://api.datalaser247.com/api/guest/events');
        return $response->json('data.events');
    }

    private function groupEventsByType($events)
    {
        $groupedEvents = [];
        foreach ($events as $event) {
            $eventTypeId = $event['event_type_id'];
            if (!isset($groupedEvents[$eventTypeId])) {
                $groupedEvents[$eventTypeId] = [];
            }
            $groupedEvents[$eventTypeId][] = $event;
        }
        return collect($groupedEvents);
    }

    private function fetchEventDetails($eventId)
    {
        $response = $this->httpClient->request('POST', "https://api.datalaser247.com/api/guest/event/{$eventId}");
        return json_decode($response->getBody()->getContents(), true);
    }

    private function extractMarketIds($event)
    {
        $marketIds = [];

        // Extract from match_odds
        if (isset($event['match_odds']['market_id'])) {
            $marketIds[] = $event['match_odds']['market_id'];
        }

        // Extract from book_makers
        if (isset($event['book_makers']) && is_array($event['book_makers'])) {
            foreach ($event['book_makers'] as $bookMaker) {
                if (isset($bookMaker['market_id'])) {
                    $marketIds[] = $bookMaker['market_id'];
                }
            }
        }

        // Extract from fancy
        if (isset($event['fancy']) && is_array($event['fancy'])) {
            foreach ($event['fancy'] as $fancy) {
                if (isset($fancy['market_id'])) {
                    $marketIds[] = $fancy['market_id'];
                }
            }
        }

        // Extract from markets
        if (isset($event['markets']) && is_array($event['markets'])) {
            foreach ($event['markets'] as $market) {
                if (isset($market['market_id'])) {
                    $marketIds[] = $market['market_id'];
                }
            }
        }

        return array_unique($marketIds); // Ensure market IDs are unique
    }

    private function fetchMarketData($marketIds)
    {
        $responses = [];
        foreach ($marketIds as $marketId) {
            $response = $this->httpClient->request('POST', 'https://odds.laser247.online/ws/getMarketDataNew', [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => ['market_ids[]' => $marketId],
            ]);

            $marketDataString = trim($response->getBody()->getContents());
            $marketDataArray = explode('|', $marketDataString);

            $responses[$marketId] = $marketDataString;
        }

        return ['rows' => $responses];
    }

    private function fetchScoreData($eventId)
    {
        $url = 'https://odds.cricbet99.club/ws/getScoreData';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['event_id' => $eventId]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded; charset=UTF-8']);

        $content = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            curl_close($ch);
            abort(500, 'cURL Error: ' . curl_error($ch));
        }

        curl_close($ch);

        return [
            'content' => $content,
            'status' => $status
        ];
    }

    private function handleNoContentResponse($httpStatusCode)
    {
        return $httpStatusCode === 204 ? 'No content available for this event' : '';
    }

    public function showInPlayEvents()
    {
        // Fetch events from the API
        $events = $this->fetchEvents();
        
        // Fetch event types from the menu
        $eventTypes = $this->fetchEventTypes();
    
        // Group events by their type and status
        $groupedEvents = $this->categorizeEvents($events, $eventTypes);
 // Extract market_ids from the categorized events
 $marketIds = $this->extractMarketInIds($groupedEvents);


 $marketData = $this->fetchMarketData(array_unique($marketIds));
        return view('inplay_events', [
            'rows' =>  $marketData,
            'menuData' => $this->commonController->list_menu(),
            'groupedEvents' => $groupedEvents,
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus(),
        ]);
    }
    
   
    
    private function fetchEventTypes()
    {
        $response = $this->httpClient->request('GET', 'https://api.datalaser247.com/api/guest/menu');
        $menuData = json_decode($response->getBody()->getContents(), true);
        return collect($menuData['data']['menu'])->pluck('name', 'id');
    }
    
    private function categorizeEvents($events, $eventTypes)
    {
        // Group events by event type ID and filter based on status
        $groupedEvents = [
            'In-Play' => [],
            'Today' => [],
            'Tomorrow' => [],
        ];
    
        foreach ($events as $event) {            
    
            $eventTypeId = $event['event_type_id'];
            $eventTypeName = $eventTypes->get($eventTypeId, 'Unknown');
    
            // Determine the event status
            if (isset($event['open_date'])) {
                $eventDate = \Carbon\Carbon::parse($event['open_date']);
            } else {
                // If open_date is not available, use a default date or skip
                $eventDate = \Carbon\Carbon::now()->subDays(1); // Example: assume it is yesterday
            }
    
            $now = \Carbon\Carbon::now();
    
            if ($event['in_play'] == 1) {
                $groupedEvents['In-Play'][$eventTypeName][] = $event;
            } elseif ($eventDate->isToday()) {
                $groupedEvents['Today'][$eventTypeName][] = $event;
            } elseif ($eventDate->isTomorrow()) {
                $groupedEvents['Tomorrow'][$eventTypeName][] = $event;
            }
        }

 //$groupedEvents = $this->addMarketDataToGroupedEvents($groupedEvents, $marketData);

        return $groupedEvents;
    }


    private function extractMarketInIds($groupedEvents)
{
    $marketIds = [];

    foreach ($groupedEvents as $status => $eventTypes) {
        foreach ($eventTypes as $eventTypeName => $events) {
            foreach ($events as $event) {
                if (isset($event['market_id'])) {
                    $marketIds[] = $event['market_id'];
                }
            }
        }
    }

    return $marketIds;
}

private function addMarketDataToGroupedEvents($groupedEvents, $marketData)
{
    foreach ($groupedEvents as $groupKey => &$group) {
        foreach ($group as $eventType => &$events) {
            foreach ($events as $index => &$event) {
                // Ensure 'market_id' is present and convert it to a string
                $marketId = (string)trim($event['market_id']);
// //dd($marketId);
// dd($marketData["rows"][$marketId]);
                // Debugging: Check if the key exists
                if (isset($marketData["rows"][$marketId])) {
                   
                    // Access the market data
                    $groupedEvents[$groupKey][$eventType][$index]['market_data'] = $marketData["rows"][$marketId];
                } else {
                   
                    // Handle missing market data
                    $groupedEvents[$groupKey][$eventType][$index]['market_data'] = null;
                    
                    // Debugging output
                    error_log("Market data not found for market ID: " . $marketId);

                    // Output available keys for further debugging
                    error_log("Available keys in marketData: " . implode(', ', array_keys($marketData)));
                }
            }
        }
    }

    return $groupedEvents;
}


    
}
