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
                $market_data = collect($parsedData)->firstWhere('market_id', $market_id);
            @endphp

            @if($market_data)
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
                            $backValues = [];
                            $layValues = [];

                            // Iterate through active segments and separate back and lay values
                            foreach ($market_data['active_segments'] as $segment) {
                                if ($segment['active'] === 'ACTIVE') {
                                    // Separate values into back and lay
                                    $values = $segment['values'];

                                    // Back values: first 6
                                    $backValues = array_merge($backValues, array_slice($values, 0, 6));

                                    // Lay values: remaining
                                    $layValues = array_merge($layValues, array_slice($values, 6));
                                }
                                // Ensure values are sorted and chunked
                            usort($backValues, fn($a, $b) => ($b <=> $a));
                            usort($layValues, fn($a, $b) => ($a <=> $b));

                            // Create pairs
                            $backPairs = array_chunk(array_slice($backValues, 0, 6), 2);
                            $layPairs = array_chunk(array_slice($layValues, 0, 6), 2);
                            }


                        @endphp

                        <div class="row mx-0 odds_body">
                            <div class="col-md-5 col-7 px-0">
                                <p class="team-name">{{ $market_runners['name'] }}</p>
                            </div>
                            <div class="col-md-7 col-5 px-0">
                                <div class="btn-group dOddsBox">
                                    @foreach($backPairs as $backPair)
                                        <button class="back back{{ $key }}">
                                            {{ $backPair[0] ?? '' }} <span>{{ $backPair[1] ?? '' }}</span>
                                        </button>
                                    @endforeach

                                    @foreach($layPairs as $layPair)
                                        <button class="lay lay{{ $key }}">
                                            {{ $layPair[0] ?? '' }} <span>{{ $layPair[1] ?? '' }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
        @endif
    @endforeach
@endif
