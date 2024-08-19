@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $event['name'] }}</h1>
    <p><strong>Competition:</strong> {{ $event['competition_id'] }}</p>
    <p><strong>Event Type ID:</strong> {{ $event['event_type_id'] }}</p>
    <p><strong>Open Date:</strong> {{ $event['open_date'] }}</p>
    <p><strong>Status:</strong> {{ $event['status'] == 0 ? 'Upcoming' : 'In Play' }}</p>

    @if (isset($eventDetails['data']['event']['match_odds']))
        <h2>Match Odds</h2>
        @foreach ($eventDetails['data']['event']['match_odds'] as $odds)
            <div>
                <p><strong>Market Name:</strong> {{ $odds['market_name'] }}</p>
                <p><strong>Min Bet:</strong> {{ $odds['min_bet'] }}</p>
                <p><strong>Max Bet:</strong> {{ $odds['max_bet'] }}</p>
            </div>
        @endforeach
    @endif
</div>

@endsection
