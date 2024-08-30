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