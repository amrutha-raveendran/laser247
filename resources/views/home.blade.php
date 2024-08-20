@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="marquee-box">
            <h4 class="marquee-h4"><i class="fa fa-microphone" aria-hidden="true"></i>  News</h4>
            <marquee>This is a sample scrolling text .</marquee>

        </div>
    </div>
    <div class="row no-gutters"> 
        @if(!empty($games))
            @foreach($games as $game)
                <div class="col-3 p-1">
                    <img src="{{ $game['image'] }}" class="img-fluid" alt="{{ $game['name'] }}"> 
                </div>
            @endforeach
        @else
            <p>No games available.</p>
        @endif
    </div>
</div>
@endsection


