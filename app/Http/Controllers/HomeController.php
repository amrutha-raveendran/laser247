<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
        // $this->middleware('auth');
    }

    public function index()
    {
        try {
            $event_list = $evnt_list='';

            // Fetch the data from the API using Guzzle
            $response = $this->httpClient->request('GET', 'https://tezcdn.com/mac88-casino-blue');
            $event_list = $this->httpClient->request('GET', 'https://api.datalaser247.com/api/guest/menu');
            

            // Check for a successful response
            if ($response->getStatusCode() == 200) {
                // Decode the JSON response
                $games = json_decode($response->getBody(), true);
                $evnt_list = json_decode($event_list->getBody(),true);
              

                if (is_array($games)) {
                    return view('home', compact('games','evnt_list'));
                } else {
                    Log::error('Unexpected JSON structure', ['response' => $games]);
                    return view('home', ['games' => []]);
                }
            } else {
                // Log the error and return an empty array
                Log::error('API request failed', [
                    'status' => $response->getStatusCode(), 
                    'response' => $response->getBody()->getContents()
                ]);
                return view('home', ['games' => []]);
            }
        } catch (\Exception $e) {
            // Log the exception and return an empty array
            Log::error('Exception occurred: ' . $e->getMessage());
            return view('home', ['games' => []]);
        }
    }
}
