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
