@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="marquee-box">
            <h4 class="marquee-h4"><i class="fa fa-microphone" aria-hidden="true"></i>  News</h4>

        </div>
    </div>
    <div class="news-scroll-bar">
        <div class="news-content">
            <span>Breaking News: Market hits all-time high! &nbsp;&bull;&nbsp;</span>
            <span>Weather Alert: Heavy rain expected tomorrow! &nbsp;&bull;&nbsp;</span>
            <span>Sports: Local team wins championship! &nbsp;&bull;&nbsp;</span>
            <!-- Add more news items here -->
        </div>
    </div>
    <div class="row no-gutters"> 
        @if(!empty($games))
            @foreach($games as $game)
                <div class="col-4 p-1">
                    <img src="{{ $game['image'] }}" class="img-fluid" alt="{{ $game['name'] }}"> 
                </div>
            @endforeach
        @else
            <p>No games available.</p>
        @endif
    </div>
</div>
@endsection


