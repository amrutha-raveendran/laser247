@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1>Events</h1>
@php
dd($rows);

@endphp
    <ul class="nav nav-tabs" id="eventTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="inplay-tab" data-bs-toggle="tab" href="#inplay" role="tab" aria-controls="inplay" aria-selected="true">In-Play</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="today-tab" data-bs-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="false">Today</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tomorrow-tab" data-bs-toggle="tab" href="#tomorrow" role="tab" aria-controls="tomorrow" aria-selected="false">Tomorrow</a>
        </li>
    </ul>

    <div class="tab-content mt-3" id="eventTabsContent">
        <div class="tab-pane fade show active" id="inplay" role="tabpanel" aria-labelledby="inplay-tab">
            @foreach($groupedEvents['In-Play'] as $eventTypeName => $events)
                <h2>{{ $eventTypeName }}</h2>
                <ul class="list-unstyled">
                    @foreach($events as $event)
                        <li>
                            <a href="{{ route('event.details', $event['event_id']) }}">
                                {{ $event['name'] }} ({{ $event['competition_name'] }}) - {{ \Carbon\Carbon::parse($event['open_date'])->format('d M Y H:i') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>

        <div class="tab-pane fade" id="today" role="tabpanel" aria-labelledby="today-tab">
            @foreach($groupedEvents['Today'] as $eventTypeName => $events)
                <h2>{{ $eventTypeName }}</h2>
                <ul class="list-unstyled">
                    @foreach($events as $event)
                        <li>
                            <a href="{{ route('event.details', $event['event_id']) }}">
                                {{ $event['name'] }} ({{ $event['competition_name'] }}) - {{ \Carbon\Carbon::parse($event['open_date'])->format('d M Y H:i') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>

        <div class="tab-pane fade" id="tomorrow" role="tabpanel" aria-labelledby="tomorrow-tab">
            @foreach($groupedEvents['Tomorrow'] as $eventTypeName => $events)
                <h2>{{ $eventTypeName }}</h2>
                <ul class="list-unstyled">
                    @foreach($events as $event)
                        <li>
                            <a href="{{ route('event.details', $event['event_id']) }}">
                                {{ $event['name'] }} ({{ $event['competition_name'] }}) - {{ \Carbon\Carbon::parse($event['open_date'])->format('d M Y H:i') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
@endsection
