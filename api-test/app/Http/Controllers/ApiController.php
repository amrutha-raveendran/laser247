<?php

namespace App\Http\Controllers;

use App\Events\EventMarket;
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
    // public function event()
    // {
    //     $response = Http::post('https://odds.l247.biz/ws/getMarketDataNew');

    //     if ($response->successful()) {
    //         // Get the data from the response
    //         $events = $response->json();

    //         // Initialize an array to store the processed event data
    //         $eventList = [];

    //         // Loop through each event in the response
    //         foreach ($events as $event) {
    //             // Create an array for each event based on the expected fields
    //             $eventData = [
    //                 'event_id' => $event['event_id'],
    //                 'book_maker_id' => $event['book_maker_id'],
    //                 'team' => [
    //                     'team_name' => $event['name'],
    //                     'back_odds' => $event['back'],
    //                     'lay_odds' => $event['lay'],
    //                     'back_volume' => $event['back_volume'],
    //                     'lay_volume' => $event['lay_volume'],
    //                     'ball_running' => $event['ball_running'],
    //                     'suspended' => $event['suspended'],
    //                     'status' => $event['status'],
    //                 ],
    //             ];

    //             // Append this structured data to the event list
    //             $eventList[] = $eventData;
    //         }

    //         // Debug and dump the $eventList to inspect its structure
    //         dd($eventList);
    //     } else {
    //         // If the response fails, log the error and dump the status code
    //         Log::error('Request failed', ['status' => $response->status(), 'body' => $response->body()]);
    //         dd('Request failed', $response->status());
    //     }

    //     // Pass the processed event data to the view
    //     return view('detail', compact('eventList'));
    // }

    public function eventDetail($id)
    {
        $client = new Client();

        try {
            // Use POST request to fetch the event data using the ID
            $response = Http::post("https://api.datalaser247.com/api/guest/event/{$id}");
            $eventData = $response->json();


            if ($response->successful()) {
                // Get the event details
                $event = $eventData['data']['event']['event'] ?? null;

                // Initialize an array to collect market_ids
                $marketIds = [];
                $marketTypeIds = [];

                // Check if the data and event keys exist
                if (isset($eventData['data']['event'])) {
                    $eventDetails = $eventData['data']['event'];

                    // Extract market_ids from match_odds, book_makers, fancy, and markets
                    $marketSources = ['match_odds', 'book_makers', 'fancy', 'markets'];

                    foreach ($marketSources as $source) {
                        // Ensure that the source is not null and is an array
                        if (isset($eventDetails[$source]) && is_array($eventDetails[$source])) {
                            foreach ($eventDetails[$source] as $item) {
                                // Safely check for market_id and market_type_id
                                if (!empty($item['market_id'])) {
                                    $marketIds[] = $item['market_id'];
                                }
                                if (!empty($item['market_type_id'])) {
                                    $marketTypeIds[] = $item['market_type_id'];
                                }
                            }
                        }
                    }
                }
                // dd($eventDetails);
                // dd($marketIds);
                if (empty($marketIds)) {
                    throw new \Exception('No market_ids found in the event data.');
                }
                $lastElement = array_pop($marketIds);
                array_unshift($marketIds, $lastElement);

                // Make the second API request using the market_ids
                $response2 = $client->post('https://odds.l247.biz/ws/getMarketDataNew', [
                    'form_params' => [
                        'market_ids[]' => $marketIds,
                    ],
                ]);

                try {
                    $response3 = $client->post('https://odds.l247.biz/ws/getScoreData', [
                        'form_params' => [
                            'event_id' => $event['id'],
                        ],
                    ]);


                    $scoreData = $response3->getBody()->getContents();
                } catch (\Exception $e) {

                    $scoreData = null;
                }
                // dd($scoreData);

                // Process the second API response
                $marketData = json_decode($response2->getBody()->getContents(), true);

                // Format the response data as needed
                $formattedMarketData = array_map(function ($item) {
                    return explode('|', $item);
                }, $marketData);
                // Prepare the data for the view
                $firstItem = $formattedMarketData[0] ?? [];

                $items = [];
                foreach ($formattedMarketData as $key => $value) {
                    $items["item" . ($key + 1)] = $value;
                }
                $data = [
                    'event' => $event,
                    'items' => $items,
                    'eventDetails' => $eventDetails,
                    'marketIds' => $marketIds,

                ];
                $compressedData = base64_encode(gzcompress(serialize($data)));
                // dd($compressedData);
                // $jsonData = json_encode($data);
                // $dataSize = strlen($jsonData);
                // dd($dataSize);

                // dd($items);
                // Return the view with event details and market data
                // Compress and encode the data for safe transmission

                return view('detail', [
                    'event' => $event,
                    'items' => $items,
                    'eventDetails' => $eventDetails,
                    'marketIds' => $marketIds,
                    'htmlContent' => $scoreData
                ]);
            } else {
                throw new \Exception('Failed to fetch event data from the API.');
            }
        } catch (RequestException $e) {
            Log::error('API Request Failed', [
                'message' => $e->getMessage(),
                'request' => (string) $e->getRequest()->getBody(),
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);
            dd('Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('General Error', ['message' => $e->getMessage()]);
            dd('Error: ' . $e->getMessage());
        }
    }


    public function fetchEventDetails(int $id): JsonResponse
    {
        $response = Http::post("https://api.datalaser247.com/api/guest/event/{$id}");

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch event data. Please try again later.'], 500);
        }

        $eventData = $response->json();
        $eventDetails = $eventData['data']['event'] ?? null;

        if (!$eventDetails) {
            return response()->json(['error' => 'No event details found.'], 404);
        }

        $event = $eventDetails['event'] ?? null;
        if (!$event) {
            return response()->json(['error' => 'No event found in the event details.'], 404);
        }

        $marketIds = $this->extractMarketIds($eventDetails);
        if (empty($marketIds)) {
            return response()->json(['error' => 'No market_ids found in the event data.'], 404);
        }

        // Rotate market_ids
        if (count($marketIds) > 1) {
            $lastElement = array_pop($marketIds);
            array_unshift($marketIds, $lastElement);
        }

        $marketDataResponse = $this->fetchMarketData($marketIds);
        if (!$marketDataResponse) {
            return response()->json(['error' => 'Failed to fetch market data.'], 500);
        }
        // Step 1: Serialize the data
        // $serializedEventData = json_encode($event);
        // $serializedMarketData = json_encode($marketDataResponse['items']);
        // $serializedEventDetails = json_encode($eventDetails);
        // $serializedMarketIds = json_encode($marketIds);

        // // Step 2: Compress and encode each piece of data
        // $compressedEventData = base64_encode(gzcompress($serializedEventData));
        // $compressedMarketData = base64_encode(gzcompress($serializedMarketData));
        // $compressedEventDetails = base64_encode(gzcompress($serializedEventDetails));
        // $compressedMarketIds = base64_encode(gzcompress($serializedMarketIds));

        // // Step 3: Broadcast the compressed and encoded data
        // broadcast(new EventMarket($compressedEventData, $compressedMarketData, $compressedEventDetails, $compressedMarketIds));

        broadcast(new EventMarket($event, $marketDataResponse['items'], $eventDetails, $marketIds));

        return response()->json(['message' => 'Event data updated successfully!'], 200);
    }

    private function fetchMarketData(array $marketIds): ?array
    {
        $response = Http::asForm()->post('https://odds.l247.biz/ws/getMarketDataNew', [
            'market_ids' => $marketIds,
        ]);

        if (!$response->successful()) {
            return null; // Handle failure gracefully
        }

        $marketData = $response->json();
        return $this->formatMarketData($marketData);
    }

    private function formatMarketData(array $marketData): array
    {
        return [
            'items' => array_map(fn($item) => explode('|', $item), $marketData),
        ];
    }

    private function extractMarketIds(array $eventDetails): array
    {
        $marketIds = [];
        $marketSources = ['match_odds', 'book_makers', 'fancy', 'markets'];

        foreach ($marketSources as $source) {
            if (!empty($eventDetails[$source]) && is_array($eventDetails[$source])) {
                foreach ($eventDetails[$source] as $item) {
                    if (!empty($item['market_id'])) {
                        $marketIds[] = $item['market_id'];
                    }
                }
            }
        }

        return $marketIds;
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




    public function event()
    {
        $client = new Client();

        try {
            // Make both API requests
            $responses = [
                $client->post('https://odds.l247.biz/ws/getMarketDataNew', [
                    'form_params' => [
                        'market_ids[]' => ['8.88888261', '1.232341137'],
                    ],
                ]),
                $client->post('https://odds.l247.biz/ws/getMarketDataNew', [
                    'form_params' => [
                        'market_ids[]' => [
                            '1.233371067',
                            '1.233506615',
                            '1.233506617',
                            '8.88890548',
                            '8.88890550',
                            '8.88890549',
                            '9.912297454',
                            '9.912297500',
                            '9.912297929',
                            '9.912297930',
                            '9.912297938',
                            '9.912297939',
                            '9.912297514'
                        ]
                    ],
                ])
            ];

            // Process the responses
            $formattedResponses = array_map(function ($response) {
                $data = json_decode($response->getBody()->getContents(), true);
                return array_map(fn($item) => explode('|', $item), $data);
            }, $responses);

            // Extract specific items
            [$firstItem, $secondItem] = $formattedResponses[0];
            $formattedResponse1 = $formattedResponses[1];
            dd($formattedResponse1);

            // Use a loop to avoid manually assigning all the items
            $items = [];
            foreach ($formattedResponse1 as $key => $value) {
                $items["item" . ($key + 1)] = $value;
            }
            // dd($formattedResponse1);
            // dd($items);

            return view('market-Data', compact('firstItem', 'items'));
        } catch (RequestException $e) {
            Log::error('API Request Failed', [
                'message' => $e->getMessage(),
                'request' => (string) $e->getRequest()->getBody(),
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);
            dd('Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error('General Error', ['message' => $e->getMessage()]);
            dd('Error: ' . $e->getMessage());
        }
    }
}
