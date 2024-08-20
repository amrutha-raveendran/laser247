@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Event Details</h2>
    
    <!-- Match Odds Section -->
    <h3>Match Odds</h3>
    @foreach($matchOdds['runners'] as $runner)
        <div>
            <strong>{{ $runner['name'] }}</strong>
            @if(isset($runner['back']) && isset($runner['lay']))
                <div>
                    Back: {{ implode(' | ', array_column($runner['back'], 'price')) }}
                    <br>
                    Lay: {{ implode(' | ', array_column($runner['lay'], 'price')) }}
                </div>
            @endif
        </div>
    @endforeach
    
    <!-- Over/Under 2.5 Goals Section -->
    @foreach($overUnderGoals as $market)
        @if($market['market_type_id'] === 'OVER_UNDER_25')
            <h3>{{ $market['market_name'] }}</h3>
            @foreach($market['runners'] as $runner)
                <div>
                    <strong>{{ $runner['name'] }}</strong>
                    @if(isset($runner['back']) && isset($runner['lay']))
                        <div>
                            Back: {{ implode(' | ', array_column($runner['back'], 'price')) }}
                            <br>
                            Lay: {{ implode(' | ', array_column($runner['lay'], 'price')) }}
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    @endforeach
</div>
@endsection
