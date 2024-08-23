@extends('layouts.main')
@section('content')
<div class="container mb-2">
    <div class="row">
        <div class="col-md-2">
            @include('components.sidebar')
        </div>
        <div class="col-md-7">
            @if(isset($htmlContent) && !empty($htmlContent))
                <!-- Display the HTML content -->
                {!! $htmlContent !!}
            @else
                <p>No event details available.</p>
            @endif
            <!-- <div class="sr-widget-1"></div> -->
            @if(isset($event_details))
                @if(isset($event_details['data']['event']))
                    @if(isset($event_details['data']['event']['match_odds']))
                        <div class="dScreen">
                            <div class="row mx-0 head_bg">
                                <div class="col-md-12 col-8 px-0">
                                    <p class="match-odds">{{ $event_details['data']['event']['match_odds']['market_name']}} 
                                        <a  href="javascript:void(0)">
                                            <i  class="mdi mdi-information-outline"></i>
                                        </a>
                                    </p>
                                </div>
                                <div  class="col-md-6 col-4 text-end px-0 d-inline-block d-lg-none">
                                    <a  href="javascript:void(0)" class="btn btn-tv-bets mob_open_bets">
                                        <span>Bets</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row mx-0 odds_header">
                                <div class="col-md-5 col-7 px-0">
                                    <div  class="minmax mm-fi">
                                        <dl class="fancy-info">
                                            <dt>Min/Max</dt>
                                            <dd>100-10k</dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="col-md-7 col-5 px-0">
                                    <div  class="btn-group dOddsBox">
                                        <button class="back2"></button>
                                        <button class="back1"></button>
                                        <button class="back">back</button>
                                        <button class="lay">lay</button>
                                        <button class="min-max-bet">
                                            <dl class="fancy-info">
                                                <dt>Min/Max</dt>
                                                <dd>100-10k</dd>
                                            </dl>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @if(isset($event_details['data']['event']['match_odds']['runners']))                           
                                @foreach($event_details['data']['event']['match_odds']['runners'] as $runners)
                                    <div class="row mx-0 odds_body">          
                                        <div class="col-md-5 col-7 px-0">
                                            <p class="team-name">{{$runners['name'] }}</p>
                                        </div>
                                        <div class="col-md-7 col-5 px-0">
                                            <div class="btn-group dOddsBox">


                                            @if(isset($rows) && !empty($rows))
                <!-- Display market data if available -->
               
                    @foreach($rows as $row)
                       
                            @foreach($row['odds'] as $odd)
                            <button  class="back back1">{{ $odd }}
                                                          
                            </button>
                            @endforeach                       
                            @foreach($row['values'] as $value)                            
                                <span >{{ $value }}</span>
                            @endforeach
                      
                    @endforeach
             
            @else
                <p>No market data available.</p>
            @endif


                                                <!-- <button class="back back2">1.55 <span >10381.37</span></button>
                                                <button  class="back back1">1.56 <span >2574.72</span></button>
                                                <button  class="back">1.58 <span >7032.4</span></button>
                                                <button  class="lay">1.59 <span >7875.09</span></button>
                                                <button  class="lay lay1">1.6 <span >1658.19</span></button>
                                                <button  class="lay lay2">1.61 <span >846.13</span></button> -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mx-0 odds_body">
                                    <div class="fancy_message">
                                        <span>{{ $event_details['data']['event']['match_odds']['message']}}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                    <!-- BookMakers -->
                    @if(isset($event_details['data']['event']['book_makers']))
                        @foreach($event_details['data']['event']['book_makers'] as $bookmakers)
                            <div class="dScreen book_makers">
                                <div class="row mx-0 head_bg">
                                    <div class="col-md-12 col-8 px-0">
                                        <p class="match-odds">{{ $bookmakers['title']}} 
                                            <a  href="javascript:void(0)">
                                                <i  class="mdi mdi-information-outline"></i>
                                            </a>
                                        </p>
                                    </div>
                                    <div  class="col-md-6 col-4 text-end px-0">
                                        <span  class="matched-count">Matched <strong ></strong></span>
                                    </div>
                                    <div  class="col-md-6 col-4 text-end px-0 d-inline-block d-lg-none">
                                        <a  href="javascript:void(0)" class="btn btn-tv-bets mob_open_bets">
                                            <span>Bets</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mx-0 odds_header">
                                    <div class="col-md-5 col-7 px-0">
                                        <div  class="minmax mm-fi">
                                            <dl class="fancy-info">
                                                <dt>Min/Max</dt>
                                                <dd>100-10k</dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-5 px-0">
                                        <div  class="btn-group dOddsBox">
                                            <button class="back2"></button>
                                            <button class="back1"></button>
                                            <button class="back">back</button>
                                            <button class="lay">lay</button>
                                            <button class="min-max-bet">
                                                <dl class="fancy-info">
                                                    <dt>Min/Max</dt>
                                                    <dd>100-10k</dd>
                                                </dl>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($event_details['data']['event']['match_odds']['runners']))                           
                                    @foreach($event_details['data']['event']['match_odds']['runners'] as $runners)
                                        <div class="row mx-0 odds_body">          
                                            <div class="col-md-5 col-7 px-0">
                                                <p class="team-name">{{$runners['name'] }}</p>
                                            </div>
                                            <div class="col-md-7 col-5 px-0">
                                                <div class="btn-group dOddsBox">
                                                    <button class="back back2">1.55 <span >10381.37</span></button>
                                                    <button  class="back back1">1.56 <span >2574.72</span></button>
                                                    <button  class="back">1.58 <span >7032.4</span></button>
                                                    <button  class="lay">1.59 <span >7875.09</span></button>
                                                    <button  class="lay lay1">1.6 <span >1658.19</span></button>
                                                    <button  class="lay lay2">1.61 <span >846.13</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row mx-0 odds_body">
                                        <div class="fancy_message">
                                            <span>{{ $event_details['data']['event']['match_odds']['message']}}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <!-- BookMakers -->
                @endif
            @endif 
        </div>  
        <div class="col-md-3">
            <div class="open-bets">
                <h2>Open Bets</h2>
            </div>
        </div>
    </div>
</div>
@endsection
