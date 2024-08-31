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
                            @if(isset($htmlContent) && !empty($htmlContent))
                            <!-- Display the HTML content -->
                            {!! $htmlContent !!}
                            @endif
                        </div>
                        <!-- Event Details -->
                        @if(!empty($event_details['data']['event']))
                            <div class="dScreen">
                                <!-- Match Odds Header -->
                                @isset($event_details['data']['event']['match_odds'])
                                    @include('components.odds-header', ['market' => $event_details['data']['event']['match_odds']])
                                    @php
                                        $pairs = \App\Helpers\RunnerHelper::processRunnerData($rows);

                                    @endphp
                                        @include('components.runner-odds', ['runners' => $event_details['data']['event']['match_odds']['runners'], 'pairs' => $pairs])

                                @endisset
                            </div>
                                <!-- MatchOdds -->
                                <!-- Bookmakers -->

                                @if(!empty($event_details['data']['event']['book_makers']))

                                    @foreach($event_details['data']['event']['book_makers'] as $bookmakers)
                                        @php
                                            $parsedData = \App\Helpers\RunnerHelper::filterAndParseOddsData($rows, 'BOOK_MAKER')
                                        @endphp
                                        @include('components.bookmakers', ['bookmakers' => $bookmakers, 'parsedData' => $parsedData])
                                    @endforeach

                                @endif

                                <!-- Bookmakers -->
                                <!-- Tied -->
                                @include('components.tied')
                                <!-- Tied -->
                                <!-- Fancy -->

                                @if(!empty($event_details['data']['event']['fancy']))
                                @include('components.fancy')
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
