<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use App\Services\MenuService;
use Log;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\Utils;

class EventController extends Controller
{
    protected $httpClient;
    protected $commonController;
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->httpClient = new Client();
        $this->commonController = new CommonController();
        $this->menuService = $menuService;
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

    public function testfunction()
    {
        $sideEvents = Cache::remember('side_events', 60, function () {
            return Http::get('https://api.datalaser247.com/api/guest/menu')->json();
        });
        
        $events = Cache::remember('events', 60, function () {
            return Http::get('https://api.datalaser247.com/api/guest/events')->json('data.events');
        });

        $groupedEvents = $this->groupEventsByType($events);

        return view('test_event', [
            'menuData' => $this->commonController->list_menu(),
            'groupedEvents' => $groupedEvents,
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus(),
            'side_events' => $sideEvents,
            'evnt_list' => $events
        ]);
    }

    public function getEventDetails($eventId)
    {
        $eventDetails = $this->fetchEventDetails($eventId);
        $marketIds = $this->extractMarketIds($eventDetails['data']['event'] ?? []);
        $marketData = $this->fetchMarketData($marketIds);
        $scoreData = $this->fetchScoreData($eventId);

        return view('event_details', [
            'htmlContent' => $scoreData['content'],
            'eventDetails' => $eventDetails['data']['event'] ?? [],
            'event_details' => $eventDetails,
            'rows' => $marketData['rows'],
            'message' => $this->handleNoContentResponse($scoreData['status']),
            'menuData' => $this->commonController->list_menu(),
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus()
        ]);
    }

    private function fetchEvents()
    {
        return Cache::remember('events', 60, function () {
            try {
                $response = $this->httpClient->get('https://api.datalaser247.com/api/guest/events');
                $data = json_decode($response->getBody()->getContents(), true);
                return $data['data']['events'] ?? [];
            } catch (\Exception $e) {
                Log::error('Failed to fetch events: ' . $e->getMessage());
                return [];
            }
        });
    }

    private function groupEventsByType($events)
    {
        $groupedEvents = [];
        foreach ($events as $event) {
            $eventTypeId = $event['event_type_id'];
            $groupedEvents[$eventTypeId][] = $event;
        }
        return collect($groupedEvents);
    }

    private function fetchEventDetails($eventId)
    {
        $cacheKey = "event_details_{$eventId}";
        $cacheTTL = 60;

        return Cache::remember($cacheKey, $cacheTTL, function () use ($eventId) {
            try {
                $response = Http::timeout(10)->post("https://api.datalaser247.com/api/guest/event/{$eventId}");

                if ($response->failed()) {
                    throw new \Exception("Failed to fetch event details: Status Code {$response->status()} - {$response->body()}");
                }

                $data = $response->json();
                if (!isset($data['data'])) {
                    throw new \Exception('Invalid response structure');
                }

                return $data;
            } catch (\Exception $e) {
                Log::error("Error fetching event details: " . $e->getMessage());
                return null;
            }
        });
    }

    private function extractMarketIds($event)
    {
        $marketIds = [];

        $this->extractFromEvent($event, $marketIds, 'match_odds');
        $this->extractFromEvent($event, $marketIds, 'book_makers');
        $this->extractFromEvent($event, $marketIds, 'fancy');
        $this->extractFromEvent($event, $marketIds, 'markets');

        return array_unique($marketIds);
    }

    private function extractFromEvent($event, &$marketIds, $key)
    {
        if (isset($event[$key]) && is_array($event[$key])) {
            foreach ($event[$key] as $item) {
                if (isset($item['market_id'])) {
                    $marketIds[] = $item['market_id'];
                }
            }
        }
    }



    private function fetchMarketData(array $marketIds)
    {
        $batchSize = 50; 
        $batches = array_chunk($marketIds, $batchSize);
        $results = [];
        
        foreach ($batches as $batch) {
            $promise = $this->httpClient->postAsync('https://odds.laser247.online/ws/getMarketDataNew', [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => ['market_ids' => $batch],
                'timeout' => 10,
            ])->then(
                function ($response) {                   
                    $marketDataString = trim($response->getBody()->getContents());
                    Log::debug('Market data response:', ['response' => $marketDataString]);                    
                    
                    // Assuming the API response is in JSON format, decode it
                    return json_decode($marketDataString, true);  // Decode the JSON response to an array
                }
            )->otherwise(
                function (\Exception $e) {  // Catch all exceptions
                    Log::error('Error fetching market data: ' . $e->getMessage());
                    return ['Error' => []];  // Return the error in a structured way
                }
            );
    
            $batchResult = $promise->wait();
    
            foreach ($batch as $index => $marketId) {
                if (isset($batchResult[$index])) {
                    $results[$marketId] = $batchResult[$index];
                } else {
                    $results[$marketId] = [];
                }
            }
        }
    
        Log::debug('Fetched market data:', ['results' => $results]);
        // Do not use dd in production, only for debugging purposes. Consider returning or processing the results further.
        return ['rows' => $results];
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
        $events = $this->fetchEvents();
        $eventTypes = $this->menuService->getMenuData();
        $groupedEvents = $this->categorizeEvents($events, $eventTypes);
        $marketIds = $this->extractMarketInIds($groupedEvents);
        $marketData = $this->fetchMarketData(array_unique($marketIds));
//dd($marketIds);
        return view('inplay_events', [
            'rows' => $marketData,
            'menuData' => $this->commonController->list_menu(),
            'groupedEvents' => $groupedEvents,
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus()
        ]);
    }

    private function categorizeEvents($events, $eventTypes)
    {
        $groupedEvents = [
            'In-Play' => [],
            'Today' => [],
            'Tomorrow' => []
        ];

        foreach ($events as $event) {
            $eventTypeId = $event['event_type_id'];
            $eventTypeName = $eventTypes->get($eventTypeId, 'Unknown');
            $eventDate = isset($event['open_date']) ? \Carbon\Carbon::parse($event['open_date']) : \Carbon\Carbon::now()->subDays(1);
            $now = \Carbon\Carbon::now();

            if ($event['in_play'] == 1) {
                $groupedEvents['In-Play'][$eventTypeName][] = $event;
            } elseif ($eventDate->isToday()) {
                $groupedEvents['Today'][$eventTypeName][] = $event;
            } elseif ($eventDate->isTomorrow()) {
                $groupedEvents['Tomorrow'][$eventTypeName][] = $event;
            }
        }
        return $groupedEvents;
    }

    private function extractMarketInIds($groupedEvents)
    {
        $marketIds = [];

        foreach ($groupedEvents as $eventTypes) {
            foreach ($eventTypes as $events) {
                foreach ($events as $event) {
                    if (isset($event['market_id'])) {
                        $marketIds[] = $event['market_id'];
                    }
                }
            }
        }

        return $marketIds;
    }
    public function fetchInPlayEvents()
    {
        // Fetch in-play events data from the API or other source
        $response = Http::get('API_URL'); // Replace 'API_URL' with your actual API endpoint

        $data = $response->json();

        // Example structure, adjust based on actual API response
        $groupedEvents = $data['groupedEvents'];
        $marketData = $data['marketData'];

        return response()->json([
            'groupedEvents' => $groupedEvents,
            'marketData' => $marketData
        ]);
    }

}
