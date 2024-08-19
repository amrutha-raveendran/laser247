@extends('layouts.main')
@section('content')
<div class="container">



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


