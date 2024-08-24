@extends('layouts.main')

@section('content')
<div class="container mb-2">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2">
            @include('components.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-7">
            <!-- Display HTML Content -->
            @if(isset($htmlContent) && !empty($htmlContent))
                {!! $htmlContent !!}
            @else
                <p>No event details available.</p>
            @endif

            <!-- Event Details -->
            @if(isset($event_details['data']['event']))
                @if(isset($event_details['data']['event']['match_odds']))
                    <div class="dScreen">
                        <!-- Match Odds Header -->
                        <div class="row mx-0 head_bg">
                            <div class="col-md-12 col-8 px-0">
                                <p class="match-odds">
                                    {{ $event_details['data']['event']['match_odds']['market_name'] }}
                                    <a href="javascript:void(0)">
                                        <i class="mdi mdi-information-outline"></i>
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-6 col-4 text-end px-0 d-inline-block d-lg-none">
                                <a href="javascript:void(0)" class="btn btn-tv-bets mob_open_bets">
                                    <span>Bets</span>
                                </a>
                            </div>
                        </div>

                        <!-- Odds Header -->
                        <div class="row mx-0 odds_header">
                            <div class="col-md-5 col-7 px-0">
                                <div class="minmax mm-fi">
                                    <dl class="fancy-info">
                                        <dt>Min/Max</dt>
                                        <dd>100-10k</dd>
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

                        <!-- Display Runners -->
                        @if(isset($event_details['data']['event']['match_odds']['runners']))
                            @php
                                // Ensure $rows is an array and contains at least one element
                                if (isset($rows) && !empty($rows)) {
                                    // Split the data from the first row
                                    $firstRow = reset($rows);
                                    $rowData = explode('|', $firstRow); // Split data from the first row

                                    // Remove the first 10 elements
                                    $rowData = array_slice($rowData, 10);
                                    
                                    // Indices to remove
                                    $indicesToRemove = [12, 13, 26, 27];
                                    
                                    // Remove specified indices
                                    foreach ($indicesToRemove as $index) {
                                        if (isset($rowData[$index])) {
                                            unset($rowData[$index]);
                                        }
                                    }
                                    
                                    // Re-index the array
                                    $rowData = array_values($rowData);

                                    // Group remaining data into pairs
                                    $pairs = [];
                                    for ($i = 0; $i < count($rowData); $i += 2) {
                                        if (isset($rowData[$i + 1])) {
                                            $pairs[] = [$rowData[$i], $rowData[$i + 1]];
                                        } else {
                                            // Handle the case where the array has an odd number of elements
                                            $pairs[] = [$rowData[$i]];
                                        }
                                    }
                                }

                                // Initialize the pair index
                                $pairIndex = 0;
                            @endphp

                            @foreach($event_details['data']['event']['match_odds']['runners'] as $runner)
                                <div class="row mx-0 odds_body">
                                    <div class="col-md-5 col-7 px-0">
                                        <p class="team-name">{{ $runner['name'] }}</p>
                                    </div>
                                    <div class="col-md-7 col-5 px-0">
                                        <div class="btn-group dOddsBox">
                                            @php
                                                // Get the next 6 pairs for the current runner
                                                $runnerPairs = array_slice($pairs, $pairIndex, 6);
                                                $pairIndex += 6;
                                            @endphp

                                            @foreach($runnerPairs as $pair)
                                                <button class="btn {{ count($pair) == 2 ? 'pair-button' : 'single-button' }}">
                                                    @foreach($pair as $data)
                                                        <span>{{ $data }}</span>
                                                    @endforeach
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <!-- Bookmakers -->
                        @if(isset($event_details['data']['event']['book_makers']))
                            @foreach($event_details['data']['event']['book_makers'] as $bookmakers)
                                <div class="dScreen book_makers">
                                    <div class="row mx-0 head_bg">
                                        <div class="col-md-12 col-8 px-0">
                                            <p class="match-odds">
                                                {{ $bookmakers['title'] }}
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
                                                    <dd>100-10k</dd>
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
                                    @if(isset($event_details['data']['event']['match_odds']['runners']))
                                        @foreach($event_details['data']['event']['match_odds']['runners'] as $runners)
                                            <div class="row mx-0 odds_body">
                                                <div class="col-md-5 col-7 px-0">
                                                    <p class="team-name">{{ $runners['name'] }}</p>
                                                </div>
                                                <div class="col-md-7 col-5 px-0">
                                                    <div class="btn-group dOddsBox">
                                                        <button class="back back2">1.55 <span>10381.37</span></button>
                                                        <button class="back back1">1.56 <span>2574.72</span></button>
                                                        <button class="back">1.58 <span>7032.4</span></button>
                                                        <button class="lay">1.59 <span>7875.09</span></button>
                                                        <button class="lay lay1">1.6 <span>1658.19</span></button>
                                                        <button class="lay lay2">1.61 <span>846.13</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row mx-0 odds_body">
                                            <div class="fancy_message">
                                                <span>{{ $event_details['data']['event']['match_odds']['message'] }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            @endif
        </div>

        <!-- Open Bets Sidebar -->
        <div class="col-md-3">
            <div class="open-bets">
                <h2>Open Bets</h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any JavaScript code required for the page here
</script>
@endsection
