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