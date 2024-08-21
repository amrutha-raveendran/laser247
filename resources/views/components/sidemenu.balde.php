@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <!-- Include Sidebar Component -->
        @include('components.sidebar')

        <!-- Your other content or sections can go here -->
    </div>
</div>
@endsection
<!-- resources/views/components/sidebar.blade.php -->
<div class="col-md-3">
    <div class="sidebar-menu">

    </div>
    <h3>Categories</h3>
    <ul>
     
        @foreach ($menu as $item)
            @if ($groupedEvents->has($item['id']))
                <li>
                    <button class="collapsible">{{ $item['name'] }}</button>
                    <div class="content">
                        @foreach ($groupedEvents[$item['id']] as $competitionName => $events)
                            <button class="collapsible">{{ $competitionName }}</button>
                            <div class="content">
                                <ul>
                                    @foreach ($events as $event)
                                        <li>
                                            <a href="{{ route('event.details', ['eventId' => $event['event_id']]) }}">
                                                {{ $event['name'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div>

<li>
                <a href="#" class="menu-link">Services <span class="arrow">&#9660;</span></a>
                <ul class="submenu">
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Development</a></li>
                    <li><a href="#">SEO</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-link">About <span class="arrow">&#9660;</span></a>
                <ul class="submenu">
                    <li><a href="#">Our Team</a></li>
                    <li><a href="#">Our History</a></li>
                </ul>
            </li>

<!-- JavaScript for Collapsible Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const coll = document.querySelectorAll('.collapsible');
        coll.forEach(function (button) {
            button.addEventListener('click', function () {
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        });
    });
</script>

<style>
    /* Optional: Additional styling for the collapsible menu */
    
</style>
