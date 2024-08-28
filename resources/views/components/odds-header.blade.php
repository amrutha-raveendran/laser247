<div class="row mx-0 head_bg">
    <div class="col-md-12 col-8 px-0">
        <p class="match-odds">
            {{ $event_details['data']['event']['match_odds']['market_name'] }}
            <a href="javascript:void(0)"><i class="mdi mdi-information-outline"></i></a>
        </p>
    </div>
    <div class="col-md-6 col-4 text-end px-0 d-inline-block d-lg-none">
        <a href="javascript:void(0)" class="btn btn-tv-bets mob_open_bets"><span>Bets</span></a>
    </div>
</div>
<div class="row mx-0 odds_header">
    <div class="col-md-5 col-7 px-0">
        <div class="minmax mm-fi">
            <dl class="fancy-info">
                <dt>Min/Max</dt>
                <dd>{{ number_format($market['min_bet'], 0) }}- {{ \App\Helpers\CustomHelper::format_number($market['max_bet']) }}</dd>
            </dl>
        </div>
    </div>
    <div class="col-md-7 col-5 px-0">
        <div class="btn-group dOddsBox">
            <button class="back2"></button>
            <button class="back1"></button>
            <button class="back">back</button>
            <button class="lay">lay</button>
            <button class="min-max-bet">
                <dl class="fancy-info">
                    <dt>Min/Max</dt>
                    <dd>100-10k</dd>
                </dl>
            </button>
        </div>
    </div>
</div>
