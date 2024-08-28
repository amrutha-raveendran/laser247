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
                    <div class="col-xl-8 px-lg-1">
                        <div class="col-md-12">
                            <div  class="marquee-box">
                                <h4 ><i  class="mdi mdi-microphone-outline"></i> News </h4>
                                <marquee  scrollamount="5"></marquee>
                            </div>
                        </div>
                        <div class="col-md-12">
                            
                        </div>
                        <!-- Event Details -->
                        @if(isset($event_details['data']['event']))
                            <div class="dScreen">
                                <!-- Match Odds Header -->
                                @isset($event_details['data']['event']['match_odds'])
                                    @include('components.odds-header', ['market' => $event_details['data']['event']['match_odds']])
                                    @php
                                        $pairs = \App\Helpers\RunnerHelper::processRunnerData($rows);
                                        $pairIndex = 0;
                                    @endphp
                                    @foreach($event_details['data']['event']['match_odds']['runners'] as $runner)
                                        @include('components.runner-odds', ['runner' => $runner, 'pairs' => $pairs, 'pairIndex' => $pairIndex])
                                    @endforeach
                                @endisset
                            </div>
                                <!-- MatchOdds -->
                                <!-- Bookmakers -->
                            
                                @if(isset($event_details['data']['event']['book_makers']))
                                
                                    @foreach($event_details['data']['event']['book_makers'] as $bookmakers)
                                        @php
                                            $parsedData = \App\Helpers\RunnerHelper::filterAndParseOddsData($rows, 'BOOKMAKER');
                                        @endphp
                                        @include('components.bookmakers', ['bookmakers' => $bookmakers, 'parsedData' => $parsedData])
                                    @endforeach
                           
                                @endif
                            
                                <!-- Bookmakers -->
                                <!-- Tied Match -->
                                @if(isset($event_details['data']['event']['markets']))
                                    @foreach($event_details['data']['event']['markets'] as $markets_data)
                                        @if($markets_data['market_type_id']!='MATCH_ODDS')
                                            <div class="dScreen">
                                                <div  class="row mx-0 head_bg">
                                                    <div  class="col-md-12 col-8 px-0">
                                                        <p  class="match-odds">{{ $markets_data['market_name']}} <i  class="mdi mdi-information-outline"></i></p>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 odds_header">
                                                    <div class="col-md-5 col-7 px-0">
                                                        <div  class="minmax mm-fi">
                                                            <dl class="fancy-info">
                                                                <dt>Min/Max</dt>
                                                                <dd>100-150k</dd>
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
                                                                    <dd>{{ number_format($markets_data['min_bet'], 0)}}- {{ \App\Helpers\CustomHelper::format_number($markets_data['max_bet'])}}</dd>
                                                                </dl>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($markets_data['runners'] as $market_runners)
                                                <div class="row mx-0 odds_body">          
                                                    <div class="col-md-5 col-7 px-0">
                                                        <p class="team-name">{{$market_runners['name'] }}</p>
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
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <!-- Tied Match -->
                                <!-- Fancy -->
                                @if(isset($event_details['data']['fancy_tab']) && (isset($event_details['data']['event']['fancy'])))
                                    <div class="dScreen fancy_odds">
                                        <div  class="row mx-0 head_bg">
                                            <div  class="col-md-12 col-8 px-0">
                                                <p  class="match-odds">fancy <i  class="mdi mdi-information-outline"></i></p>
                                            </div>
                                        </div>
                                        <tabset  type="nav de_fancyTab"  class="tab-container">
                                            <ul class="nav  de_fancyTab" id="myTab" role="tablist" aria-label="Tabs">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" href="javascript:void(0);" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"  role="tab" aria-controls="all" aria-selected="true">
                                                    <span ></span><span  style="text-transform: uppercase;">All</span>  </a>
                                                </li>
                                                @foreach($event_details['data']['fancy_tab'] as $key =>$fancy_tab_odds)
                                                    <li  class="nav-item active">
                                                        <a class="nav-link" href="javascript:void(0);" id="{{str_replace(' ', '-', $key)}}-tab" data-bs-toggle="tab" data-bs-target="#{{str_replace(' ', '-', $key)}}"  role="tab" aria-controls="{{$key}}" aria-selected="false">  
                                                        <span ></span><span  style="text-transform: uppercase;">{{$key}}</span>
                                                        </a>
                                                    </li>
                                                    
                                                @endforeach
                                                
                                            </ul>
                                        </tabset>
                                        <!-- Tabs Content -->
                                        <div class="tab-content" id="myTabContent">
                                            <!-- All Tab Content -->
                                            <tab  id="all" role="tabpanel" aria-labelledby="all-tab" class="tab-pane fade show active">
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
                                                        @foreach($event_details['data']['event']['fancy'] as $fkey=> $fancy_tabs)
                                                            <div>
                                                                <div>
                                                                    <div class="row mx-0 odds_body">
                                                                        <div class="col-md-5 col-7 px-0">
                                                                            <p class="team-name"><b>{{ $fancy_tabs['name']}}</b></p>
                                                                            <span class="mo_min-max"><b>min max</b>100-100k</span>
                                                                        </div>
                                                                        <div class="col-md-7 col-5 px-0">
                                                                            <div class="btn-group dOddsBox">
                                                                                <button class="back back2"></button>
                                                                                <button class="back back1"></button>
                                                                                <button class="lay">0.00 <span>0.00</span></button><button class="back">0.00 <span>0.00</span></button>
                                                                                <button class="min-max-bet">
                                                                                    <dl class="fancy-info">
                                                                                        <dd>{{ number_format($fancy_tabs['min_bet'], 0)}}- {{ \App\Helpers\CustomHelper::format_number($fancy_tabs['max_bet'])}}</dd>
                                                                                    </dl>
                                                                                </button>
                                                                                <div class="suspended">suspended</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="fancy_message"><span>{{ $fancy_tabs['message'] }}</span></div>
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </tab>
                                            @foreach($event_details['data']['fancy_tab'] as $fkey =>$fancy_tab_odds)
                                                <tab class="tab-pane fade" id="{{str_replace(' ', '-', $fkey)}}" role="tabpanel" aria-labelledby="{{str_replace(' ', '-', $fkey)}}-tab">
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
                                                            @foreach($event_details['data']['event']['fancy'] as $fkeyy=> $fancy_tabs)
                                                            @if(!empty($fancy_tabs['sort_priority']))
                                                            @if(in_array($fancy_tabs['sort_priority'],$event_details['data']['fancy_tab'][$fkey]))
                                                                <div>
                                                                    <div>
                                                                        <div class="row mx-0 odds_body">
                                                                            <div class="col-md-5 col-7 px-0">
                                                                                <p class="team-name"><b>{{ $fancy_tabs['name']}}</b></p>
                                                                                <span class="mo_min-max"><b>min max</b>100-100k</span>
                                                                            </div>
                                                                            <div class="col-md-7 col-5 px-0">
                                                                                <div class="btn-group dOddsBox">
                                                                                    <button class="back back2"></button>
                                                                                    <button class="back back1"></button>
                                                                                    <button class="lay">0.00 <span>0.00</span></button><button class="back">0.00 <span>0.00</span></button>
                                                                                    <button class="min-max-bet">
                                                                                        <dl class="fancy-info">
                                                                                            <dd>{{ number_format($fancy_tabs['min_bet'], 0)}}- {{ \App\Helpers\CustomHelper::format_number($fancy_tabs['max_bet'])}}</dd>
                                                                                        </dl>
                                                                                    </button>
                                                                                    <div class="suspended">suspended</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="fancy_message"><span>{{ $fancy_tabs['message'] }}</span></div>
                                                                        </div>
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
                                <!-- Fancy -->
                            </div>
                        @endif
                        <!--  -->
                    
                    <!-- Right Sidebar -->
                      @include('components.bet_sidebar')
                    <!-- Right Sidebar -->
                </div>
            </div>
        </div>
       </div>
    <!-- Content -->
 @endsection