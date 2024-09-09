@if(isset($event_details['data']['event']['markets']))
    @foreach($event_details['data']['event']['markets'] as $markets_data)
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
                        // Extract all values from the market_data's active segments
                        $allValues = collect($market_data['active_segments'])
                            ->flatMap(fn($segment) => $segment['values'])
                            ->take(24)
                            ->all();

                        // Limit to 12 back values and 12 lay values
                        $backValues = array_slice($allValues, 0, 12);
                        $layValues = array_slice($allValues, 12, 12);

                        // Only keep complete pairs
                        $backValues = array_chunk($backValues, 2);
                        $layValues = array_chunk($layValues, 2);
                    @endphp

                    <div class="row mx-0 odds_body">
                        <div class="col-md-5 col-7 px-0">
                            <p class="team-name">{{ $market_runners['name'] }}</p>
                        </div>
                        <div class="col-md-7 col-5 px-0">
                            <div class="btn-group dOddsBox">
                                @foreach(array_slice($backValues, 0, 3) as $backPair)
                                    @foreach($backPair as $index => $backValue)
                                        <button class="back back{{ $key }}">
                                            {{ $backValue }} <span>{{ $backPair[$index + 1] ?? '' }}</span>
                                        </button>
                                    @endforeach
                                @endforeach

                                @foreach(array_slice($layValues, 0, 3) as $layPair)
                                    @foreach($layPair as $index => $layValue)
                                        <button class="lay lay{{ $key }}">
                                            {{ $layValue }} <span>{{ $layPair[$index + 1] ?? '' }}</span>
                                        </button>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
@endif
