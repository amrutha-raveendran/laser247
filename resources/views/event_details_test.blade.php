@extends('layouts.main-demo')
@section('content')
    <!-- Sidebar -->
    @include('components.side_new')
    <!-- Sidebar -->
    <!-- Content -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-xl-8 px-lg-1">
                        <div class="col-md-12">
                            <div class="marquee-box">
                                <h4><i class="mdi mdi-microphone-outline"></i> News </h4>
                                <marquee scrollamount="5"></marquee>
                            </div>
                        </div>
                        
                        <div class="col-12 bg-dark">
                            <h2 class="eventTitle"> 
                                {{ $event_details['data']['event']['event']['name']}}
                                @if($event_details['data']['event']['event']['in_play'])
                                    <span>In Play</span>
                                @endif
                            </h2>
                        </div>

                        <div class="col-md-12">
                            @if (isset($htmlContent) && !empty($htmlContent))
                                <!-- Display the HTML content -->
                                {!! $htmlContent !!}
                            @endif
                        </div>
                        @if (!empty($event_details['data']['event']))
                            <div class="dScreen">
                                <!------------------------ MatchOdds--------------------------->
                                @if(!empty($event_details['data']['event']['match_odds']))
                                    <div class="row mx-0 head_bg">
                                        <div class="col-md-12 col-8 px-0">
                                            <p class="match-odds">
                                                @if(isset($event_details['data']['event']['match_odds']['market_name']) && !empty($event_details['data']['event']['match_odds']['market_name']))
                                                    {{ $event_details['data']['event']['match_odds']['market_name'] }}
                                                @endif
                                                <a href="javascript:void(0)"><i class="mdi mdi-information-outline"></i></a>
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-4 text-end px-0 d-inline-block d-lg-none">
                                            <a href="javascript:void(0)" class="btn btn-tv-bets mob_open_bets"><span>Bets</span></a>
                                        </div>
                                    </div>
                                    <div class="row mx-0 odds_header">
                                        <div class="col-md-5 col-7 px-0">
                                            <div class="minmax mm-fi">
                                                <dl class="fancy-info">
                                                    <dt>Min/Max</dt>
                                                    <dd>
                                                        @if(isset($market['min_bet']) && isset($market['max_bet']))
                                                            {{ number_format($market['min_bet'], 0) }}- {{ \App\Helpers\CustomHelper::format_number($market['max_bet']) }}
                                                        @endif
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-5 px-0">
                                            <div class="btn-group dOddsBox">
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
                                    
                                    
                                    @php
                                    // Initialize pairIndex
                                        $pairIndex = 0;
                                        // Limit to only three runners
                                        $maxRunners = 3;
                                        $runners = $event_details['data']['event']['match_odds']['runners'];
                                    @endphp
                              
                                    @foreach($runners as $runner)
                                    
                                        @php
                                        
                                            $pairs = \App\Helpers\RunnerHelper::check_matchoddvalue_in_detail($event_details['data']['event']['match_odds']['market_id'],$rows,$runner['selection_id']);
                                        @endphp
                                        @php    
                                            // Slice 6 pairs for the current runner
                                            //$runnerPairs = array_slice($pairs, $pairIndex, 6);
                                            // Update pairIndex for the next runner
                                            //$pairIndex += 6;
                                        @endphp
                                        <div class="row mx-0 odds_body">
                                            <div class="col-md-5 col-7 px-0">
                                                <p class="team-name">{{ $runner['name'] }}</p>
                                            </div>
                                            <div class="col-md-7 col-5 px-0">
                                                <div class="btn-group dOddsBox">
                                                    
                                                    @if(!empty($pairs))
                                                   
                                                        <div class="btn-group dOddsBox">
                                                            <button  class="back back2">{{$pairs[4]}} 
                                                                <span>{{$pairs[5]}}</span>
                                                            </button>
                                                            <button class="back back1">{{$pairs[2]}}
                                                                 <span>{{$pairs[3]}}</span>
                                                            </button>
                                                            <button  class="back">{{$pairs[0]}} 
                                                                <span>{{$pairs[1]}}</span>
                                                            </button>
                                                            <button class="lay">{{$pairs[6]}}
                                                                <span >{{$pairs[7]}}</span>
                                                            </button>
                                                            <button  class="lay lay1">{{$pairs[8]}}
                                                                <span>{{$pairs[9]}}</span>
                                                            </button>
                                                            <button  class="lay lay2">{{$pairs[10]}}
                                                                <span>{{$pairs[11]}}</span>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if(isset($event_details['data']['event']['match_odds']['message']))
                                        <div class="row mx-0 odds_body">
                                            <div class="fancy_message">
                                                <span>{{ $event_details['data']['event']['match_odds']['message']}}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endif
                        <!------------------------ MatchOdds--------------------------->

                        <!------------------------ BookMakers--------------------------->
                        @if(!empty($event_details['data']['event']['book_makers']))
                            @foreach($event_details['data']['event']['book_makers'] as $bookmakers)
                                @if($bookmakers['status'] == 1)
                                    <div class="dScreen book_makers">
                                        <div class="row mx-0 head_bg">
                                            <div class="col-md-12 col-8 px-0">
                                                <p class="match-odds">{{ $bookmakers['title']}}
                                                    <a href="javascript:void(0)">
                                                        <i class="mdi mdi-information-outline"></i>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-4 text-end px-0">
                                                <span class="matched-count">Matched <strong></strong></span>
                                            </div>
                                            <div class="col-md-6 col-4 text-end px-0 d-inline-block d-lg-none">
                                                <a href="javascript:void(0)" class="btn btn-tv-bets mob_open_bets">
                                                    <span>Bets</span>
                                                </a>
                                            </div>
                                        </div>
                                       
                                        <div class="row mx-0 odds_header">
                                            <div class="col-md-5 col-7 px-0">
                                                <div class="minmax mm-fi">
                                                    <dl class="fancy-info">
                                                        <dt>Min/Max</dt>
                                                        <dd>
                                                            @if(isset($bookmakers['min_bet']) && isset($bookmakers['max_bet']))
                                                                {{ number_format($bookmakers['min_bet'], 0) }}- {{ \App\Helpers\CustomHelper::format_number($bookmakers['max_bet']) }}
                                                            @endif
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-5 px-0">
                                                <div class="btn-group dOddsBox">
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
                                        @if(isset($bookmakers['book_maker_odds']))                          
                                            @foreach($bookmakers['book_maker_odds'] as $bkmakr)
                                                @php
                                                   $bookmaker_pairs = \App\Helpers\RunnerHelper::check_bookmaker_in_detail($bookmakers['event_id'],$bookmakers['market_id'],$rows,$bkmakr['selection_id'],$bkmakr['book_maker_id']);
                                              
                                                @endphp
                                                @if(!empty($bookmaker_pairs))
                                                    <div class="row mx-0 odds_body">          
                                                        <div class="col-md-5 col-7 px-0">
                                                            <p class="team-name">{{ $bkmakr['name']}}</p>
                                                        </div>
                                                        <div class="col-md-7 col-5 px-0">
                                                            <div class="btn-group dOddsBox">
                                                                <!-- Ensure that indices match expected values -->
                                                                <button class="back back2">--<span>--</span></button>
                                                                <button class="back back1">--<span>--</span></button>
                                                                <button class="back">{{$bookmaker_pairs[1] ?? '-'}} <span>{{$bookmaker_pairs[2] ?? '-'}}</span></button>
                                                                <button class="lay">{{$bookmaker_pairs[3] ?? '-'}} <span>{{$bookmaker_pairs[4] ?? '-'}}</span></button>
                                                                <button class="lay lay1">-- <span>--</span></button>
                                                                <button class="lay lay2"> -- <span>--</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <!------------------------ BookMakers--------------------------->
                        
                        <!-- --------------------- Fancy ------------------------------->
                        @if (!empty($event_details['data']['event']['fancy']))
                            @if(isset($event_details['data']['fancy_tab']) && isset($event_details['data']['event']['fancy']))
                                <div class="dScreen fancy_odds">
                                    <div class="row mx-0 head_bg">
                                        <div class="col-md-12 col-8 px-0">
                                            <p class="match-odds">fancy <i class="mdi mdi-information-outline"></i></p>
                                        </div>
                                    </div>
                                    <tabset type="nav de_fancyTab" class="tab-container">
                                        <ul class="nav de_fancyTab" id="myTab" role="tablist" aria-label="Tabs">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" href="javascript:void(0);" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" role="tab" aria-controls="all" aria-selected="true">
                                                    <span></span><span style="text-transform: uppercase;">All</span>
                                                </a>
                                            </li>
                                            @foreach($event_details['data']['fancy_tab'] as $key => $fancy_tab_odds)
                                                <li class="nav-item">
                                                    <a class="nav-link" href="javascript:void(0);" id="{{ str_replace(' ', '-', $key) }}-tab" data-bs-toggle="tab" data-bs-target="#{{ str_replace(' ', '-', $key) }}" role="tab" aria-controls="{{ str_replace(' ', '-', $key) }}" aria-selected="false">
                                                        <span></span><span style="text-transform: uppercase;">{{ $key }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </tabset>
                                    <!-- Tabs Content -->
                                    <div class="tab-content" id="myTabContent">
                                        <!-- All Tab Content -->
                                        <tab id="all" role="tabpanel" aria-labelledby="all-tab" class="tab-pane fade show active">
                                            <div>
                                                <div class="row mx-0 odds_header">
                                                    <div class="col-md-5 col-7 px-0"></div>
                                                    <div class="col-md-7 col-5 px-0">
                                                        <div class="btn-group dOddsBox">
                                                            <button class="lay2"></button>
                                                            <button class="lay1"></button>
                                                            <button class="lay">no</button>
                                                            <button class="back">yes</button>
                                                            <button class="min-max-bet">Min-Max</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($event_details['data']['event']['fancy']))
                                                    @foreach($event_details['data']['event']['fancy'] as $fancy_tabs)
                                                        @php
                                                            $fancy_pairs = \App\Helpers\RunnerHelper::check_fancy_in_detail($fancy_tabs['event_id'],$fancy_tabs['market_id'],$rows,$fancy_tabs['selection_id'],$fancy_tabs['id']);
                                                        @endphp
                                                        @if (!empty($fancy_pairs))
                                                            <div>
                                                                <div class="row mx-0 odds_body">
                                                                    <div class="col-md-5 col-7 px-0">
                                                                        <p class="team-name"><b>{{ $fancy_tabs['name'] }}</b></p>
                                                                        <span class="mo_min-max"><b>min max</b>
                                                                            @if(isset($fancy_tabs['min_bet']) && isset($fancy_tabs['max_bet']))
                                                                                {{ number_format($fancy_tabs['min_bet'], 0) }}- {{ \App\Helpers\CustomHelper::format_number($fancy_tabs['max_bet']) }}
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    <div class="col-md-7 col-5 px-0">
                                                                        <div class="btn-group dOddsBox">
                                                                            <!-- Display the odds values based on the title -->
                                                                            <button class="back back2"></button>
                                                                            <button class="back back1"></button>
                                                                            <button class="lay">{{ $fancy_pairs['12']}} <span>{{ $fancy_pairs['11']}}</span></button>
                                                                            <button class="back"> {{ $fancy_pairs['10']}}<span>{{ $fancy_pairs['9']}}</span></button>
                                                                            <button class="min-max-bet">
                                                                                <dl class="fancy-info">
                                                                                    <dd>{{ number_format($fancy_pairs['0'], 0) }}- {{ \App\Helpers\CustomHelper::format_number($fancy_pairs['1']) }}</dd>

                                                                                </dl>
                                                                            </button>
                                                                            <!-- <div class="suspended">suspended</div> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="fancy_message"><span>{{ $fancy_tabs['message'] }}</span></div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </tab>
                                        <!-- Dynamic Fancy Tab Content -->
                                        @foreach($event_details['data']['fancy_tab'] as $fkey => $fancy_tab_odds)
                                            <tab class="tab-pane fade" id="{{ str_replace(' ', '-', $fkey) }}" role="tabpanel" aria-labelledby="{{ str_replace(' ', '-', $fkey) }}-tab">
                                                <div>
                                                    <div class="row mx-0 odds_header">
                                                        <div class="col-md-5 col-7 px-0"></div>
                                                        <div class="col-md-7 col-5 px-0">
                                                            <div class="btn-group dOddsBox">
                                                                <button class="lay2"></button>
                                                                <button class="lay1"></button>
                                                                <button class="lay">no</button>
                                                                <button class="back">yes</button>
                                                                <button class="min-max-bet">Min-Max</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(isset($event_details['data']['event']['fancy']))
                                                        @foreach($event_details['data']['event']['fancy'] as $fancy_tabs)
                                                            @if (!empty($fancy_tabs['sort_priority']) && in_array($fancy_tabs['sort_priority'], $event_details['data']['fancy_tab'][$fkey]))
                                                                @php
                                                                     $fancy_values = \App\Helpers\RunnerHelper::check_fancy_in_detail($fancy_tabs['event_id'],$fancy_tabs['market_id'],$rows,$fancy_tabs['selection_id'],$fancy_tabs['id']);
                                                                @endphp
                                                                @if (!empty($fancy_values))
                                                                <div>
                                                                    <div class="row mx-0 odds_body">
                                                                        <div class="col-md-5 col-7 px-0">
                                                                            <p class="team-name"><b>{{ $fancy_tabs['name'] }}</b></p>
                                                                            <span class="mo_min-max"><b>min max</b> 100-100k</span>
                                                                        </div>
                                                                        <div class="col-md-7 col-5 px-0">
                                                                            <div class="btn-group dOddsBox">
                                                                                <!-- Display the odds values based on the title -->
                                                                                <button class="back back2"></button>
                                                                                <button class="back back1"></button>
                                                                                <button class="lay">{{ $fancy_values['12'] }} <span>{{ $fancy_values['11'] }}</span></button>
                                                                                <button class="back">{{ $fancy_values['10'] }} <span>{{ $fancy_values['9'] }}</span></button>
                                                                                <button class="min-max-bet">
                                                                                    <dl class="fancy-info">
                                                                                        <dd>{{ number_format($fancy_values['0'], 0) }}- {{ \App\Helpers\CustomHelper::format_number($fancy_values['1']) }}</dd>
                                                                                    </dl>
                                                                                </button>
                                                                                <!-- <div class="suspended">suspended</div> -->
                                                                            </div>
                                                                        </div>
                                                                        <div class="fancy_message"><span>{{ $fancy_tabs['message'] }}</span></div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </tab>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endif
                            <!----------------------- Fancy ------------------------------->
                            <!----------------------  Market ------------------------------>
                            {{ $match_value = false}}
                            @if(isset($event_details['data']['event']['markets']))
                                @foreach($event_details['data']['event']['markets'] as $markets_data)
                                    @if($markets_data['status']=='1')
                                        @if(!empty($event_details['data']['event']['match_odds']) && !empty($event_details['data']['event']['markets']))
                                            @php $match_value = \App\Helpers\RunnerHelper::check_matchoddvalue_in_markets($event_details['data']['event']['match_odds'],$markets_data['id']) @endphp
                                        @endif
                                        @if(!$match_value)
                                            @php
                                                $market_id = $markets_data['market_id'];
                                                // Find the corresponding market data from the parsedData based on market_id
                                                //$market_data = collect($parsedData)->firstWhere('market_id', $market_id);
                                                
                                                
                                            @endphp
                                                <div class="dScreen">
                                                    <div class="row mx-0 head_bg">
                                                        <div class="col-md-12 col-8 px-0">
                                                            <p class="match-odds">{{ $markets_data['market_name'] }} <i class="mdi mdi-information-outline"></i></p>
                                                        </div>
                                                    </div>
                                                    <div class="row mx-0 odds_header">
                                                        <div class="col-md-5 col-7 px-0">
                                                            <div class="minmax mm-fi">
                                                                <dl class="fancy-info">
                                                                    <dt>Min/Max</dt>
                                                                    <dd>100-150k</dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 col-5 px-0">
                                                            <div class="btn-group dOddsBox">
                                                                <button class="back2"></button>
                                                                <button class="back1"></button>
                                                                <button class="back">back</button>
                                                                <button class="lay">lay</button>
                                                                <button class="min-max-bet">
                                                                    <dl class="fancy-info">
                                                                        <dt>Min/Max</dt>
                                                                        <dd>{{ number_format($markets_data['min_bet'], 0) }} - {{ \App\Helpers\CustomHelper::format_number($markets_data['max_bet']) }}</dd>
                                                                    </dl>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach($markets_data['runners'] as $key => $market_runners)
                                                        @php
                                                            $market_data =  \App\Helpers\RunnerHelper::check_matchoddvalue_in_detail($markets_data['market_id'],$rows,$market_runners['selection_id']);
                                                         
                                                        @endphp
                                                        @if($market_data)
                                                            <div class="row mx-0 odds_body">
                                                                <div class="col-md-5 col-7 px-0">
                                                                    <p class="team-name">{{ $market_runners['name'] }}</p>
                                                                </div>
                                                                <div class="col-md-7 col-5 px-0">
                                                                    @if(!empty($market_data))
                                                                        <div class="btn-group dOddsBox">
                                                                            <button  class="back back2">{{$market_data[4]}} 
                                                                                <span>{{$market_data[5]}}</span>
                                                                            </button>
                                                                            <button class="back back1">{{$market_data[2]}}
                                                                                    <span>{{$market_data[3]}}</span>
                                                                            </button>
                                                                            <button  class="back">{{$market_data[0]}} 
                                                                                <span>{{$market_data[1]}}</span>
                                                                            </button>
                                                                            <button class="lay">{{$market_data[6]}}
                                                                                <span >{{$market_data[7]}}</span>
                                                                            </button>
                                                                            <button  class="lay lay1">{{$market_data[8]}}
                                                                                <span>{{$market_data[9]}}</span>
                                                                            </button>
                                                                            <button  class="lay lay2">{{$market_data[10]}}
                                                                                <span>{{$market_data[11]}}</span>
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            
                                                        @endif

                                                        
                                                    @endforeach
                                                </div>
                                           
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                            <!---------------------   Market ------------------------------>
                        </div>
                    <!-- Main Content -->
                    <!-- Right Sidebar -->
                    @include('components.bet_sidebar')
                    <!-- Right Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- Content -->
@endsection
@section('script')
<script>
    setTimeout(pollService, 1000);
    function pollService()
    {
        
    }
</script>
@endsection
