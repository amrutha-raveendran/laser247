<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MarketDataController extends Controller
{
    public function getMarketData(Request $request)
    {
        // Example payload
        $payload = [
            'market_ids' => [
                '1724112000',
                '9.82408209500',
                '9.82408209501',
                '9.82408209502',
                
            ],
        ];

        // API endpoint
        $url = 'https://odds.laser247.online/ws/getMarketDataNew';

        // Sending the POST request
        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json, text/plain, */*',
           // 'Authorization' => 'Bearer ' . $request->header('Authorization'), // Add auth if needed
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Origin' => 'https://laser247.online',
            'Referer' => 'https://laser247.online/',
            'User-Agent' => $request->header('User-Agent'), // You can pass the user-agent from the request
        ])->post($url, $payload);

        // Check if the request was successful
        if ($response->successful()) {
            // Decode the response JSON
            $data = $response->json();

            // Return the response data to the client, or handle it as needed
            return response()->json($data);
        } else {
            // Handle the error
            return response()->json(['error' => 'Failed to fetch market data'], 500);
        }
    }
}
