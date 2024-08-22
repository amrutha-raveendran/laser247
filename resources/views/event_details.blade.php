@extends('layouts.main')

@section('content')
<div class="container mb-2">
    <div class="row">
        <div class="col-md-2">
            @include('components.sidebar')
        </div>
        <div class="col-md-7">
            <h2>Event Details</h2> 
            @if(isset($htmlContent) && !empty($htmlContent))
                <!-- Display the HTML content -->
                {!! $htmlContent !!}
            @else
                <p>No event details available.</p>
            @endif
        </div>  
        <div class="col-md-3">
            <div class="open-bets">
                <h2>Open Bets</h2>
            </div>
        </div>
    </div>
</div>
    
    


</div>
@endsection
