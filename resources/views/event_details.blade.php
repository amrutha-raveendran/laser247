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
                                @include('components.fancy')
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