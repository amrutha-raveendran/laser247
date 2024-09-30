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

    /**
     * Display the dashboard with grouped events and menu data.
     *
     * @return \Illuminate\View\View
     */
    public function showDashboard()
    {
        $events = $this->fetchEvents();
        $groupedEvents = $this->groupEventsByType($events);

        return view('dashboard', [
            'menuData' => $this->commonController->list_menu(),
            'groupedEvents' => $groupedEvents,
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus()
        ]);
    }
    public function showSports($sportId)
    {
        if($sportId=='99999')
        {
            try {
                $response = Http::get('https://laser247.online/assets/data/inner-page-royal-casino.json');
                $casino_events = json_decode($response->getBody(), true);

                if(is_array($casino_events))
                    return view('casino_events', [
                        'casino_events' => $casino_events,
                        'menuData' => $this->commonController->list_menu(),
                        'sidebarEvents' => $this->commonController->sidebar(),
                        'menus' => $this->commonController->header_menus()
                    ]);

            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        else if($sportId=='99995')
        {
            try {
                $response = Http::get('https://api.datalaser247.com/api/guest/casino_int');

                $intcasino_events = json_decode($response->getBody(), true);
                if(is_array($intcasino_events))
                    return view('intcasino_events', [
                        'intcasino_events' => $intcasino_events,
                        'menuData' => $this->commonController->list_menu(),
                        'sidebarEvents' => $this->commonController->sidebar(),
                        'menus' => $this->commonController->header_menus()
                    ]);

            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        else{
            $events = $this->fetchEvents();
            $event_list = $this->fetchEventByTypeId($events,$sportId);
            $marketids  = $this->getMarketids($event_list);
            $marketdata = $this->fetchMarketDataList($marketids);

            return view('event_list', [
                'eventlist'     => $event_list,
                'marketdata'    => $marketdata,
                'menuData'      => $this->commonController->list_menu(),
                'sidebarEvents' => $this->commonController->sidebar(),
                'menus'         => $this->commonController->header_menus(),
                'menu_name'     => $this->menuname($sportId)
            ]);
        }
        
    }
    /*
    Fetch market data function for event list page
    */
    private function fetchMarketDataList($marketids)
    {

        $response1 = Http::asForm()->post('https://odds.laser247.online/ws/getMarketDataNew', [
            'market_ids' => $marketids
        ]);
        if ($response1->successful()) {
            $marketDatas =  trim($response1->getBody()->getContents());
            return json_decode($marketDatas, true);
        }
        else{
            return ['Error' => []];
        }

    }
    public  static function getMarketids($event_list)
    {
        $market_ids = [];
        foreach ($event_list as $event) {
            $market_ids[] = $event['market_id']; // Add each market_id to the array
        }
        return $market_ids;
    }

 /*Get name from menudata */
     private function menuname($id){
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
        $result = array_filter($menuData, function($item) use ($id) {
            return $item['id'] == $id;
        });
        if (!empty($result)) {
            // Assuming there's only one match
            return reset($result)['name'];
        }
     }
 /* */

    /**
     * Fetch event details by event ID.
     *
     * @param  int  $eventId
     * @return \Illuminate\View\View
     */
    public function getEventDetails($eventId)
    {
        $eventDetails = $this->fetchEventDetails($eventId);

    // dd($eventDetails);
        $marketIds = $this->extractMarketIds($eventDetails['data']['event'] ?? []);
        $marketData = $this->fetchMarketData($marketIds);
        // dd($marketData);
        $scoreData = $this->fetchScoreData($eventId);

        return view('event_details_test', [
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

    
    public function getEventDetailsTest($eventId)
    {
        $eventDetails = $this->fetchEventDetails($eventId);
        // dd($eventDetails);
        $marketIds = $this->extractMarketIds($eventDetails['data']['event'] ?? []);
        $marketData = $this->fetchMarketData($marketIds);
        // dd($marketIds);
        // dd($marketData);
        $scoreData = $this->fetchScoreData($eventId);

        return view('event_details_test', [
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

    /**
     * Fetch events from the API with caching.
     *
     * @return array
     */
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
/** *
    * Group events by their event type id
    * @param array $events
    * @param $event_type_id
*/
    private function fetchEventByTypeId($events,$eventId)
    {
        return array_filter($events, function($event) use ($eventId) {
            return $event['event_type_id'] == $eventId;
        });
    }
    /**
     * Group events by their type ID.
     *
     * @param  array  $events
     * @return \Illuminate\Support\Collection
     */
    private function groupEventsByType($events)
    {
        $groupedEvents = [];
        foreach ($events as $event) {
            $eventTypeId = $event['event_type_id'];
            $groupedEvents[$eventTypeId][] = $event;
        }
        return collect($groupedEvents);
    }

    /**
     * Fetch event details from the API with caching.
     *
     * @param  int  $eventId
     * @return array|null
     */
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

    /**
     * Extract market IDs from the event data.
     *
     * @param  array  $event
     * @return array
     */
    private function extractMarketIds($event)
    {
        $marketIds = [];

        $this->extractFromEvent($event, $marketIds, 'match_odds');
        $this->extractFromEvent($event, $marketIds, 'book_makers');
        $this->extractFromEvent($event, $marketIds, 'fancy');
        $this->extractFromEvent($event, $marketIds, 'markets');

        return array_unique($marketIds);
    }

    /**
     * Extract market IDs from specific keys in the event data.
     *
     * @param  array  $event
     * @param  array  &$marketIds
     * @param  string $key
     * @return void
     */
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



    /**
     * Fetch market data in batches.
     *
     * @param  array  $marketIds
     * @return array
     */

     private function fetchMarketData1(array $marketIds)
     {
        try{

       
         $responses = Http::pool(fn(Pool $pool) => array_map(fn($marketId) => $pool->post('https://odds.laser247.online/ws/getMarketDataNew', [
             'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
             'form_params' => ['market_ids[]' => $marketId],
         ]), $marketIds));
        //  dd($responses);
  
         return [
             'rows' => array_map(fn($response) => trim($response->body()), $responses)
         ];
        }catch (\Exception $e) {
          
            Log::error('API request failed: ', [
                'error_message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return [
                'error' => 'An error occurred while processing the API request.'
            ];
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

                    return json_decode($marketDataString, true);
                }
            )->otherwise(
                function (\Exception $e) {
                    Log::error('Error fetching market data: ' . $e->getMessage());
                    return ['Error' => []];
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
        return ['rows' => $results];
    }

    /**
     * Fetch score data using cURL.
     *
     * @param  int  $eventId
     * @return array
     */
    private function fetchScoreData($eventId)
    {
        $url = 'https://odds.laser247.online/ws/getScoreData';
        // $response1 = $this->httpClient->post('https://odds.laser247.online/ws/getScoreData');
        $response1 = Http::asForm()->post('https://odds.laser247.online/ws/getScoreData', [
            // Ensure this payload matches what the API expects
            'event_id' => $eventId
        ]);
        // Check for a failed request
        if ($response1->successful()) {
            return ['content' => $response1,'status' => $response1->status()];
        }
        else{
            return ['content' => '','status' => $response1->status()];
        }
      
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['event_id' => $eventId]));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        // $response = curl_exec($ch);
        // $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // curl_close($ch);
        // dd($response1->body());
        // if ($status == 200) {
        //         return [
        //             'status' => $status,
        //             'content' => $response,
        //         ];
        // }
        // return [
        //     'status' => $status,
        //     'content' => '',
        // ];
    }

    /**
     * Handle the response status for no content.
     *
     * @param  int  $status
     * @return string
     */
    private function handleNoContentResponse($status)
    {
        if ($status != 200) {
            return 'No content available';
        }
        return '';
    }

    /**
     * Display the in-play events page with grouped events and market data.
     *
     * @return \Illuminate\View\View
     */
    public function showInPlayEvents()
    {
        $events = $this->fetchEvents();
        $eventTypes = $this->menuService->getMenuData();
        $groupedEvents = $this->categorizeEvents($events, $eventTypes);
        $marketIds = $this->extractMarketInIds($groupedEvents);
        $marketData = $this->fetchMarketData(array_unique($marketIds));

        return view('inplay_events', [
            'rows' => $marketData,
            'menuData' => $this->commonController->list_menu(),
            'groupedEvents' => $groupedEvents,
            'sidebarEvents' => $this->commonController->sidebar(),
            'menus' => $this->commonController->header_menus()
        ]);
    }

    /**
     * Categorize events into 'In-Play', 'Today', and 'Tomorrow' based on their type and date.
     *
     * @param  array  $events
     * @param  \Illuminate\Support\Collection  $eventTypes
     * @return array
     */
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
    /**
     * Extract market IDs from the grouped events data.
     *
     * @param  array  $groupedEvents
     * @return array
     */
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

    /**
     * Fetch in-play events data from the API and return it as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchInPlayEvents()
    {
        // Fetch in-play events data from the API
        $response = Http::get('API_URL');

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
