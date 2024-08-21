<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
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
    public function index()
    {
     
        try {
 
            // Fetch the data from the API using Guzzle
            $response = $this->httpClient->request('GET', 'https://tezcdn.com/mac88-casino-blue');
            $event_list = $this->httpClient->request('GET', 'https://api.datalaser247.com/api/guest/menu');
         

            // Check for a successful response
            if ($event_list->getStatusCode() == 200) {
                $evnt_list = json_decode($event_list->getBody(),true);
            }
            if ($response->getStatusCode() == 200) {
                // Decode the JSON response
                $games = json_decode($response->getBody(), true);
                
            } 
            if(is_array($games))
               $data['games'] = $games;

            if(is_array($evnt_list))
               $data['evnt_list'] = $evnt_list;
            // print_r($data); exit;
            
            
            if (is_array($data)) {
                return $data;
                } 
             
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }
    public function list_menu()
    {

    }

}
