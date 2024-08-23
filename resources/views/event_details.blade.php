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

            @if(isset($eventDetails))
                <!-- Display event details if available -->
                <h3>{{ $eventDetails['match_odds']['market_name'] ?? 'Market Name Not Available' }}</h3>
                @if(isset($eventDetails['match_odds']['runners']))
                    <ul>
                        @foreach($eventDetails['match_odds']['runners'] as $runner)
                            <li>{{ $runner['name'] }}</li>
                        @endforeach
                    </ul>
                @endif
            @endif

            @if(isset($rows) && !empty($rows))
                <!-- Display market data if available -->
                <table class="table table-bordered">
                    @foreach($rows as $row)
                        <tr>
                            @foreach($row['odds'] as $odd)
                                <td>{{ $odd }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach($row['values'] as $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            @else
                <p>No market data available.</p>
            @endif
        </div>  
        <div class="col-md-3">
            <div class="open-bets">
                <h2>Open Bets</h2>
            </div>
        </div>
    </div>
</div>
@endsection
