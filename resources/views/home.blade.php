@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="marquee-box">
            <h4 class="marquee-h4"><i class="fa fa-microphone" aria-hidden="true"></i>  News</h4>
            <marquee>This is a sample scrolling text .</marquee>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <img src="{{asset('assets/img/slider1.webp')}}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-6">
            <div class="as-banner-2">
                <div class="as-banner-2-img">
                    <img src="{{asset('assets/img/banner-sport1.webp')}}" alt="" class="img-fluid">
                </div>
                <div class="as-banner-2-text">
                    <p class="banner-2-p"><span class="banner-2-icon"></span>LIVE</p>
                    @if(isset($menus['evnt_list']['data']['menu']) && is_array($menus['evnt_list']['data']['menu']))
                        @foreach($menus['evnt_list']['data']['menu'] as $menuItem)
                            @if(isset($menuItem['name']) )
                                <div><a href=""><h3>{{($menuItem['name'])}}</h3></a></div>
                                @endif
                        @endforeach
                    @endif 
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{asset('assets/img/sportbook.webp')}}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row mt-0 as-banner-3">
        <div class="col-md-6">
            <img src="{{asset('assets/img/aviator-banner.webp')}}" alt="" class="img-fluid">
            <h3>Aviator</h3>
        </div>
        <div class="col-md-6">
            <img src="{{asset('assets/img/lankesh-730-280.png')}}" alt="" class="img-fluid">
            <h3>Lankesh</h3>
        </div>
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-12">
            <img src="{{asset('assets/img/fungames_1920x500.webp')}}" alt="" class="img-fluid">
            <h3>Fun Games</h3>
        </div>
    </div>
    <div class="row"> 
        @if(!empty($evnts_list['games']))
            @foreach($evnts_list['games'] as $game)
                <div class="col-3 p-1">
                    <img src="{{ $game['image'] }}" class="img-fluid" alt="{{ $game['name'] }}"> 
                </div>
            @endforeach
        @else
            <p>No games available.</p>
        @endif
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-6">
            <img src="{{asset('assets/img/livecasino.webp')}}" alt="" class="img-fluid">
        </div>
        <div class="col-md-6">
            <img src="{{asset('assets/img/intcasino.webp')}}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-3">
            <img src="{{asset('assets/img/aesexy.webp')}}" alt="" class="img-fluid">
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/playtech-500-299.webp')}}" alt="" class="img-fluid">
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/monopoly.webp')}}" alt="" class="img-fluid">
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/dreamcatcher.webp')}}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-3">
            <img src="{{asset('assets/img/coin-toss.webp')}}" alt="" class="img-fluid">
            <h3>Coin Toss</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/roulette.webp')}}" alt="" class="img-fluid">
            <h3>Rummy</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/blackjack.webp')}}" alt="" class="img-fluid">
            <h3>Roulette</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/blackjack.webp')}}" alt="" class="img-fluid">
            <h3>Blackjack</h3>
        </div>
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-3">
            <img src="{{asset('assets/img/baccarat.webp')}}" alt="" class="img-fluid">
            <h3>baccarat</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/sicbo.webp')}}" alt="" class="img-fluid">
            <h3>Sicbo</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/inc5.webp')}}" alt="" class="img-fluid">
            <h3>Ezugi</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/cricketx.webp')}}" alt="" class="img-fluid">
            <h3>cricketX</h3>
        </div>
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-3">
            <img src="{{asset('assets/img/gmx_wonhundred.webp')}}" alt="" class="img-fluid">
            <h3>Won Hundred</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/pilot.webp')}}" alt="" class="img-fluid">
            <h3>Pilot</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/mines.webp')}}" alt="" class="img-fluid">
            <h3>Mines</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/spinx.webp')}}" alt="" class="img-fluid">
            <h3>SpinX</h3>
        </div>
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-3">
            <img src="{{asset('assets/img/footballx.webp')}}" alt="" class="img-fluid">
            <h3>Football X</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/sms-jetex.webp')}}" alt="" class="img-fluid">
            <h3>JetX</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/balloon.webp')}}" alt="" class="img-fluid">
            <h3>Ballon</h3>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/vikings.webp')}}" alt="" class="img-fluid">
            <h3>Viking's Story</h3>
        </div>
    </div>
    <div class="row as-banner-3 mt-1">
        <div class="col-md-6">
            <img src="{{asset('assets/img/horseracing.webp')}}" alt="" class="img-fluid">
            <h3>Horse Racing</h3>
        </div>
        <div class="col-md-6">
            <img src="{{asset('assets/img/greyhoundracing.webp')}}" alt="" class="img-fluid">
            <h3>GreyHound Racing</h3>
        </div>
    </div>
    <div class="row mb-1">
        <div class="col-md-12">
            <div class="footer-section">
                <!-- <h3>
                    <img src="{{asset('assets/img/gc.png')}}" alt="" class="img-fluid">
                </h3>
                <div class="foot-img">
                    <img src="{{asset('assets/img/lice.png')}}" alt="" class="img-fluid">
                </div>
                <p>Laser247 is the trading name of Sports Target B.V., a company incorporated and regulated in Curaçao under company number 148053 with it's registered office at Fransche Bloemweg 4, Willemstad, Curaçao.</p> -->
            </div>
        </div>
    </div>
</div>
@endsection


