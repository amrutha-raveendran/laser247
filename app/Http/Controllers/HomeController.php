<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->CommonController = new CommonController();
        // $this->middleware('auth');
    }

    public function index()
    {
      
        return view('home', ['menus'=>$this->CommonController->header_menus(),'evnts_list'=>$this->CommonController->events_list()]);
        
    }
    public function test()
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

       // Fetch event list data from the API
       $response = Http::get('https://api.datalaser247.com/api/guest/event_list');
       $data = $response->json();

       // Group events by event_type_id and then by competition_name
       $groupedEvents = collect($data['data']['events'])->groupBy(['event_type_id', 'competition_name']);

       return view('test', ['menu' => $menuData, 'groupedEvents' => $groupedEvents,'menus'=>$this->CommonController->header_menus()]);
    }
}
