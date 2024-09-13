<div class="dScreen book_makers">
    <div class="row mx-0 head_bg">
        <div class="col-md-12 col-8 px-0">
            <p class="match-odds">{{ $bookmakers['title']}}
                <a href="javascript:void(0)">
                    <i class="mdi mdi-information-outline"></i>
                </a>
            </p>
        </div>
        <div class="col-md-6 col-4 text-end px-0">
            <span class="matched-count">Matched <strong></strong></span>
        </div>
        <div class="col-md-6 col-4 text-end px-0 d-inline-block d-lg-none">
            <a href="javascript:void(0)" class="btn btn-tv-bets mob_open_bets">
                <span>Bets</span>
            </a>
        </div>
    </div>
  
    @if(isset($bookmakers['book_maker_odds']))                          
        @foreach($bookmakers['book_maker_odds'] as $bkmakr)
           @if($bkmakr['status'] =='1')
                @php
                    $teamOdds = collect($parsedData)->firstWhere('team', $bkmakr['name']);
                @endphp

                @if($teamOdds)
                    <div class="row mx-0 odds_body">          
                        <div class="col-md-5 col-7 px-0">
                            <p class="team-name">{{ $bkmakr['name']}}</p>
                        </div>
                        <div class="col-md-7 col-5 px-0">
                            <div class="btn-group dOddsBox">
                                <!-- Ensure that indices match expected values -->
                                <button class="back back2">{{ $teamOdds[2] ?? '-' }} <span>{{ $teamOdds[1] ?? '-' }}</span></button>
                                <button class="back back1">{{ $teamOdds[2] ?? '-' }} <span>{{ $teamOdds[3] ?? '-' }}</span></button>
                                <button class="back">{{ $teamOdds['odds1'] ?? '-' }} <span>{{ $teamOdds['value1'] ?? '-' }}</span></button>
                                <button class="lay">{{ $teamOdds['odds2'] ?? '-' }} <span>{{ $teamOdds['value2'] ?? '-' }}</span></button>
                                <button class="lay lay1">{{ $teamOdds[39] ?? '-' }} <span>{{ $teamOdds[40] ?? '-' }}</span></button>
                                <button class="lay lay2">{{ $teamOdds[37] ?? '-' }} <span>{{ $teamOdds[38] ?? '-' }}</span></button>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
        <div class="row mx-0 odds_body">
            <div class="fancy_message">
                <span>{{ $bookmakers['message'] }}</span>
            </div>
        </div>
    @endif
</div>


