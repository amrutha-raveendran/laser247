@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar Component -->
        <div class="col-md-3">
            @include('components.sidebar')
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9 dashboard-container">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($menuData as $menuItem)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $menuItem['id'] }}" data-toggle="tab" href="#content-{{ $menuItem['id'] }}" role="tab" aria-controls="content-{{ $menuItem['id'] }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $menuItem['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

        <!-- Tabs Content -->
<div class="tab-content mt-3" id="myTabContent">
    @foreach ($menuData as $menuItem)
        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ $menuItem['id'] }}" role="tabpanel" aria-labelledby="tab-{{ $menuItem['id'] }}">
            @if (isset($groupedEvents[$menuItem['id']]))
                <ul>
                    @foreach ($groupedEvents[$menuItem['id']] as $event)
                        <li>
                            <a href="{{ route('event.details', ['eventId' => $event['event_id']]) }}">
                                {{ $event['name'] }}
                                @if ($event['in_play'])
                                    <span class="badge badge-success ml-2">In Play</span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No events available for this category.</p>
            @endif
        </div>
    @endforeach
</div>

        </div>
    </div>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
