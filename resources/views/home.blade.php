<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(!empty($games))
            @foreach($games as $game)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $game['image'] }}" class="card-img-top" alt="{{ $game['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game['name'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No games available.</p>
        @endif
    </div>
</div>
@endsection
