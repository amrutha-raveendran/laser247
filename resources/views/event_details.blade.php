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
            @if(!empty($htmlContent))
                {!! $htmlContent !!}
           
            @endif

            <!-- Event Details -->
            @if(isset($event_details['data']['event']['match_odds']))
             

                           
                    <!-- Match Odds Header -->
                    <div class="dScreen">
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
                    </div>
                @endif
           

            <!-- Odds Header -->
            @isset($event_details['data']['event']['match_odds'])
                @include('components.odds-header', ['market' => $event_details['data']['event']['match_odds']])
            @endisset

            <!-- Display Runners -->
            @if(isset($event_details['data']['event']['match_odds']['runners']))
                @php
                    $pairs = \App\Helpers\RunnerHelper::processRunnerData($rows);
                    $pairIndex = 0;
                @endphp

                @foreach($event_details['data']['event']['match_odds']['runners'] as $runner)
                    @include('components.runner-odds', ['runner' => $runner, 'pairs' => $pairs, 'pairIndex' => $pairIndex])
                @endforeach
            @endif
          
            <!-- Bookmakers -->
            @if(isset($event_details['data']['event']['book_makers']))
                @foreach($event_details['data']['event']['book_makers'] as $bookmakers)
                    @php
                        $parsedData = \App\Helpers\RunnerHelper::filterAndParseOddsData($rows, 'BOOKMAKER');
                    @endphp
                    @include('components.bookmakers', ['bookmakers' => $bookmakers, 'parsedData' => $parsedData])
                @endforeach
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
