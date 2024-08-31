@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1>Events</h1>
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
        @foreach(['In-Play' => 'inplay', 'Today' => 'today', 'Tomorrow' => 'tomorrow'] as $key => $tabId)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $tabId }}" role="tabpanel" aria-labelledby="{{ $tabId }}-tab">
                @if(isset($groupedEvents[$key]) && is_array($groupedEvents[$key]))
                    @foreach($groupedEvents[$key] as $eventTypeName => $events)
                        <h2>{{ $eventTypeName }}</h2>
                        <ul class="list-unstyled">
                            @foreach($events as $event)
                                @php
                                    $marketId = $event['market_id'];
                                    $marketDataString = $rows['rows'][$marketId] ?? '';
                                    $values = [];

                                    // Check if marketDataString is not empty before processing
                                    if (!empty($marketDataString)) {
                                        $data = explode('|', $marketDataString);
                                        $values = [
                                            $data[12] ?? '',
                                            $data[16] ?? '',
                                            $data[25] ?? '',
                                            $data[42] ?? ''
                                        ];
                                    }
                                @endphp
                                <li class="{{ $marketId }}">
                                    <a href="{{ route('event.details', $event['event_id']) }}">
                                        {{ $event['name'] }} ({{ $event['competition_name'] }}) - {{ \Carbon\Carbon::parse($event['open_date'])->format('d M Y H:i') }}
                                    </a>
                                    <span>
                                        @foreach($values as $value)
                                            {{ $value }} 
                                        @endforeach
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @else
                    <p>No {{ $key }} events available.</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


@endsection
