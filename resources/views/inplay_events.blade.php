<!-- resources/views/inplay_events.blade.php -->
@extends('layouts.main')

@section('content')
<div class="container">
    <h1>In-Play Events</h1>

    @foreach($groupedEvents as $eventTypeName => $events)
        <h2>{{ $eventTypeName }}</h2>
        <ul>
            @foreach($events as $event)
                <li>
                    <a href="{{ route('event.details', $event['event_id']) }}">
                        {{ $event['name'] }} ({{ $event['competition_name'] }}) - {{ $event['open_date'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach
</div>
@endsection
