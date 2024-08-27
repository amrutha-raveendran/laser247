@php
    $runnerPairs = array_slice($pairs, $pairIndex, 6);
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
