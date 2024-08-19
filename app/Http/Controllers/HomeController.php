<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    public function index()
    {
        try {
           
            // Fetch the data from the API using Http client
            $response = Http::get('https://tezcdn.com/mac88-casino-blue');

            // Check for a successful response
            if ($response->successful()) {
                // Decode the JSON response
                $games = $response->json();

               
                if (is_array($games)) {
                    return view('home', compact('games'));
                } else {
                    Log::error('Unexpected JSON structure', ['response' => $games]);
                    return view('home', ['games' => []]);
                }
            } else {
                // Log the error and return an empty array
                Log::error('API request failed', ['status' => $response->status(), 'response' => $response->body()]);
                return view('home', ['games' => []]);
            }
        } catch (\Exception $e) {
            // Log the exception and return an empty array
            Log::error('Exception occurred: ' . $e->getMessage());
            return view('home', ['games' => []]);
        }
    }
}