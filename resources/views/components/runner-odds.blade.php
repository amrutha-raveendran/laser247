@php
    // Initialize pairIndex
    $pairIndex = 0;
    // Limit to only three runners
    $maxRunners = 3;
@endphp

@foreach($runners as $runner)

    @php    
        // Slice 6 pairs for the current runner
        $runnerPairs = array_slice($pairs, $pairIndex, 6);
        
        // Update pairIndex for the next runner
        $pairIndex += 6;
    @endphp
    
    <div class="row mx-0 odds_body">
        <div class="col-md-5 col-7 px-0">
            <p class="team-name">{{ $runner['name'] }}</p>
        </div>
        <div class="col-md-7 col-5 px-0">
            <div class="btn-group dOddsBox">
                @foreach($runnerPairs as $pair)
                    <button class="btn {{ count($pair) == 2 ? 'pair-button' : 'single-button' }}">
                        @foreach($pair as $data)
                            <span>{{ $data }}</span>
                        @endforeach
                    </button>
                @endforeach
            </div>
        </div>
    </div>
@endforeach





        
             
               
