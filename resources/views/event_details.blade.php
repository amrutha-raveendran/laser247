@extends('layouts.main')
@section('content')
<div class="container mb-2">
    <div class="row">
        <div class="col-md-2">
            @include('components.sidebar')
        </div>
        <div class="col-md-7">
            <h2>Event Details</h2> 
            @if(isset($htmlContent) && !empty($htmlContent))
                <!-- Display the HTML content -->
                {!! $htmlContent !!}
            @else
                <p>No event details available.</p>
            @endif
            @if(isset($event_details))
                @if(isset($event_details['data']['event']))
                {{dd($event_details['data']['event']['match_odds'])}}
                   <!-- <h2>{{ $event_details['data']['event']['match_odds']['market_name']}}</h2>
                   @if(isset($event_details['data']['event']['match_odds']['runners']))
                     @foreach($event_details['data']['event']['match_odds']['runners'] as $runners)
                   
                     <div>{{$runners['name'] }}</div>
                     @endforeach
                   
                   @endif

                @endif -->
            @endif
        </div>  
        <div class="col-md-3">
            <div class="open-bets">
                <h2>Open Bets</h2>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
