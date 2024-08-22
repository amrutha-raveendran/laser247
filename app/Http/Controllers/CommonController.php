<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CommonController extends Controller
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client();
        // $this->middleware('auth');
    }
    //
    public function header_menus()
    {
        try {
   
 
            $event_list = $this->httpClient->request('GET', 'https://api.datalaser247.com/api/guest/menu');
         

            // Check for a successful response
            if ($event_list->getStatusCode() == 200) {
                $evnt_list = json_decode($event_list->getBody(),true);
            }

            if(is_array($evnt_list))
               $data['evnt_list'] = $evnt_list;
            if (is_array($data)) 
                return $data;

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function events_list()
    {
        try {
 
            // Fetch the data from the API using Guzzle
            $response = $this->httpClient->request('GET', 'https://tezcdn.com/mac88-casino-blue');
            // Check for a successful response
            if ($response->getStatusCode() == 200) {
                // Decode the JSON response
                $games = json_decode($response->getBody(), true);
                
            } 
            if(is_array($games))
               $data['games'] = $games;
            if (is_array($data)) 
                return $data;

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } 
    }
    public function sidebar()
    {
          // Fetch data from the API
        $response = Http::get('https://api.datalaser247.com/api/guest/events');
        $events = $response->json('data.events');
        $data = $response->json();
        $sidebarEvents = collect($data['data']['events'])->groupBy(['event_type_id', 'competition_name']);
        return $sidebarEvents;
    }
    public function list_menu()
    {
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
        return $menuData;
    }

}
