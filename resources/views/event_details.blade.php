@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Event Details</h2>
    
    @if(isset($htmlContent) && !empty($htmlContent))
        <!-- Display the HTML content -->
        {!! $htmlContent !!}
    @else
        <p>No event details available.</p>
    @endif
    


</div>
@endsection
