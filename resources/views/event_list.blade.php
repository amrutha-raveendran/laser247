@extends('layouts.main-demo')
@section('content')
    <!-- Sidebar -->
    @include('components.side_new')
    <!-- Sidebar -->
    <!-- Content -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 px-lg-1">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="marquee-box">
                                    <h4 _ngcontent-uqd-c51=""><i class="mdi mdi-microphone-outline"></i> News</h4>
                                    <marquee scrollamount="5"></marquee>
                                </div>
                                <div id="My-Slider" data-bs-ride="carousel" class="carousel slide">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#My-Slider" data-bs-slide-to="0" class="active"></li>
                                        <li data-bs-target="#My-Slider" data-bs-slide-to="1"></li>
                                        <li data-bs-target="#My-Slider" data-bs-slide-to="2"></li>
                                    </ol>
                                    <div role="listbox" class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{ asset('assets/img/bnr1.webp')}}" class="img-fluid d-none d-sm-block" /><img src="assets/img/m_bnr1.webp" class="img-fluid d-block d-sm-none" />
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('assets/img/bnr2.webp')}}" class="img-fluid d-none d-sm-block" /><img src="assets/img/m_bnr2.webp" class="img-fluid d-block d-sm-none" />
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ asset('assets/img/bnr3.webp')}}" class="img-fluid d-none d-sm-block" /><img src="assets/img/m_bnr3.webp" class="img-fluid d-block d-sm-none" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="eventlistdesign">
                                            <h2 class="high-desktop">&nbsp;&nbsp; {{ @$menu_name}}
                                                <ul class="live_virtual">
                                                    <li >
                                                        <input type="checkbox" value="Order one" id="checkboxOne-inplay" class="ng-untouched ng-pristine ng-valid" /><label for="checkboxOne-inplay">LIVE</label>
                                                    </li>
                                                    <li >
                                                        <input type="checkbox" value="Order Two" id="checkboxTwo-inplay" class="ng-untouched ng-pristine ng-valid" /><label for="checkboxTwo-inplay">VIRTUAL</label>
                                                    </li>
                                                </ul>
                                                <div class="dropdown viewby-filter">
                                                    <button type="button" id="ViewBy" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle" fdprocessedid="gesrt">
                                                        <i class="mdi mdi-filter"></i> View by
                                                    </button>
                                                    <div aria-bs-labelledby="ViewBy" class="dropdown-menu">
                                                        <a href="javascript:void(0)">Competition</a><a href="javascript:void(0)" class="active">Time</a>
                                                    </div>
                                                </div>
                                                <!---->
                                            </h2>
                                            <h2 class="high-mobile">&nbsp;&nbsp; {{ $menu_name}}
                                                <ul class="live_virtual">
                                                    <li >
                                                        <input type="checkbox" value="Order one" id="checkboxOne-inplay" class="ng-untouched ng-pristine ng-valid" /><label for="checkboxOne-inplay">LIVE</label>
                                                    </li>
                                                    <li >
                                                        <input type="checkbox" value="Order Two" id="checkboxTwo-inplay" class="ng-untouched ng-pristine ng-valid" /><label for="checkboxTwo-inplay">VIRTUAL</label>
                                                    </li>
                                                </ul>
                                                <!---->
                                                <div class="dropdown viewby-filter">
                                                    <button type="button" id="ViewBy" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
                                                        <i class="mdi mdi-filter"></i> View by
                                                    </button>
                                                    <div aria-bs-labelledby="ViewBy" class="dropdown-menu">
                                                        <a href="javascript:void(0)">Competition</a><a href="javascript:void(0)" class="active">Time</a>
                                                    </div>
                                                </div>
                                                <!---->
                                            </h2>
                                            <div>
                                                <div class="row oneX2">
                                                    <div class="col-md-7"></div>
                                                    <div class="col-md-4 px-lg-0">
                                                        <div class="oddsEventlist">
                                                            <div class="btn-group"><span >1</span></div>
                                                            <div class="btn-group"><span >X</span></div>
                                                            <div class="btn-group"><span >2</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                                <div >
                                                    @if(!empty($eventlist))
                                                    @foreach($eventlist as $evnts)
                                                        <div >
                                                            <div class="row align-items-center row-my">
                                                                <div class="col-md-6 col-10 px-1">
                                                                        <p class="matchname">
                                                                            <a class="{{($evnts['in_play']=='1')?'item-inplay':''}}">
                                                                                @if ($evnts['in_play'])
                                                                                    <img src="{{ asset('assets/img/icon-in_play.png')}}" class="img-fluid">
                                                                                @else
                                                                                    <img src="{{asset('assets/img/icon-no_play.png')}}" class="img-fluid">
                                                                                @endif
                                                                                {{ $evnts['name'] }}
                                                                            </a>
                                                                            <b>
                                                                            @if($evnts['in_play'])
                                                                                <span class="in_play img-fluid">In-Play</span>
                                                                            @endif
                                                                            @if($evnts['fancy_active'])
                                                                                <span class="game-fancy"><img src="{{ asset('assets/img/icon-fancy.svg')}}" class="img-fluid"></span>
                                                                            @endif
                                                                            @if($evnts['bm_active'])
                                                                                <span class="game-bm">
                                                                                    <img  src="{{ asset('assets/img/icon-bookmaker.svg')}}" class="img-fluid">
                                                                                </span>
                                                                            @endif
                                                                            @if($evnts['custom_active']=='T')
                                                                                <span class="game-custom">T </span>
                                                                            @endif
                                                                            @if($evnts['in_play'])
                                                                                <span class="game-bm bg-success"> P </span>   
                                                                            @endif
                                                                            @if($evnts['open_date_format'])
                                                                            <span class="timer-on">{{ date('h:i', strtotime($evnts['open_date_format'])) }}</span>
                                                                            @endif
                                                                            </b>
                                                                        </p>
                                                                </div>
                                                                <div class="col-md-1 text-lg-center tex-right col-matched"></div>
                                                                <div class="col-md-4 col px-0">
                                                                        <div class="oddsEventlist">
                                                                            <div class="btn-group">
                                                                                <button class="back">-</button><button class="lay">-</button>
                                                                            </div>
                                                                            <div class="btn-group">
                                                                                <button class="back">-</button><button class="lay">-</button>
                                                                            </div>
                                                                            <div class="btn-group">
                                                                                <button class="back">-</button><button class="lay">-</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1 col-2 text-end text-lg-center">
                                                                        <!---->
                                                                        <a href="javascript:void(0);" class="add-pins"><img src="{{ asset('assets/img/pin-white.svg')}}" class="img-fluid" /></a>
                                                                        <!---->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <div >
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mobile-hide">
                            <div class="col-md-12">
                                <div class="inner-footer">
                                    <div class="support-wrap">
                                        <dl class="support-mail">
                                            <a class="rules-btn-home">Privacy Policy</a><a class="rules-btn-home arrow">KYC</a><a class="rules-btn-home arrow">Terms and Conditions</a>
                                            <a class="rules-btn-home arrow">Rules and Regulations</a><a class="rules-btn-home arrow">Responsible Gambling</a>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Sidebar -->
                    @include('components.bet_sidebar')
                    <!-- Right Sidebar -->
                </div>
            </div>
        </div>
    </div>
    @endsection