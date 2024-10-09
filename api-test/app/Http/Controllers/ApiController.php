<?php

namespace App\Http\Controllers;

use App\Events\EventMarket;
use App\Services\EventService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function home()
    {
        $response = Http::get('https://api.datalaser247.com/api/guest/event_list');

        if ($response->successful()) {

            $events = $response->json()['data']['events'];
        } else {
            $events = [];
        }
        // dd($events);
        return view('welcome', compact('events'));
    }

    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function eventDetail($id)
    {
        $eventData = $this->eventService->fetchEventData($id);

        if (!$eventData) {
            return response()->json(['error' => 'Failed to fetch event data from the API.'], 500);
        }

        $eventDetails = $eventData['data']['event'] ?? null;

        if (!$eventDetails) {
            return response()->json(['error' => 'No event details found.'], 404);
        }

        $marketIds = $this->eventService->extractMarketIds($eventDetails);
        if (empty($marketIds)) {
            return response()->json(['error' => 'No market_ids found in the event data.'], 404);
        }

        // Rotate market_ids
        if (count($marketIds) > 1) {
            $lastElement = array_pop($marketIds);
            array_unshift($marketIds, $lastElement);
        }

        $marketDataResponse = $this->eventService->fetchMarketData($marketIds);
        if (!$marketDataResponse) {
            return response()->json(['error' => 'Failed to fetch market data.'], 500);
        }

        // Optionally, handle score data fetch similarly
        // $data = [
        //     'event' => $eventDetails['event'],
        //     'items' => $marketDataResponse['items'],
        //     'eventDetails' => $eventDetails,

        // ];
        // $jsonData = json_encode($data);
        // $compressedData = base64_encode(bzcompress($jsonData));
        // // dd($compressedData);
        // // $jsonData = json_encode($data);
        // $dataSize = strlen($compressedData);
        // dd($dataSize);
        return view('detail', [
            'event' => $eventDetails['event'],
            'items' => $marketDataResponse['items'],
            'eventDetails' => $eventDetails,
            'marketIds' => $marketIds,
            // 'htmlContent' => $scoreData // If included
        ]);
    }

    public function fetchEventDetails(int $id): JsonResponse
    {
        $eventData = $this->eventService->fetchEventData($id);

        if (!$eventData) {
            return response()->json(['error' => 'Failed to fetch event data.'], 500);
        }

        $eventDetails = $eventData['data']['event'] ?? null;
        if (!$eventDetails) {
            return response()->json(['error' => 'No event details found.'], 404);
        }

        $marketIds = $this->eventService->extractMarketIds($eventDetails);
        if (empty($marketIds)) {
            return response()->json(['error' => 'No market_ids found in the event data.'], 404);
        }

        // Rotate market_ids
        if (count($marketIds) > 1) {
            $lastElement = array_pop($marketIds);
            array_unshift($marketIds, $lastElement);
        }

        $marketDataResponse = $this->eventService->fetchMarketData($marketIds);
        if (!$marketDataResponse) {
            return response()->json(['error' => 'Failed to fetch market data.'], 500);
        }

        broadcast(new EventMarket($eventDetails['event'], $marketDataResponse['items'], $eventDetails));
        // , $marketIds

        return response()->json(['message' => 'Event data updated successfully!'], 200);
    }



    public function fetchScoreData($id)
    {
        try {
            // Use POST request to fetch the event data using the ID
            $response = Http::post("https://api.datalaser247.com/api/guest/event/{$id}");
            $eventData = $response->json();

            if (!$response->successful()) {
                return response()->json(['error' => 'Failed to fetch event data'], 500);
            }

            // Get the event details
            $event = $eventData['data']['event']['event'] ?? null;



            // Attempt to fetch score data
            $scoreData = '';
            try {
                $response3 = Http::asForm()->post('https://odds.l247.biz/ws/getScoreData', [
                    'event_id' => $event['id'],
                ]);

                if ($response3->successful()) {
                    $scoreData = $response3->body();
                }
            } catch (\Exception $e) {
                // Silent failure for score data, use empty scoreData
            }

            // Return the JSON response with all necessary data
            return response()->json([
                'htmlContent' => $scoreData
            ]);
        } catch (RequestException $e) {
            return response()->json(['error' => 'API Request Failed: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
