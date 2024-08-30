@extends('layouts.main-demo')
@section('content')
    <!-- Sidebar -->
    @include('components.side_new')
    <!-- Sidebar -->
    <!-- Main Content -->
    <div  class="content-page">
        <div  class="content">
            <div  class="container-fluid">
                <div  class="row">
                    <div  class="col-xl-8 px-lg-1">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="marquee-box">
                                    <h4 ><i  class="mdi mdi-microphone-outline"></i> News </h4>
                                    <marquee  scrollamount="5"></marquee>
                                </div>
                                <div  id="My-Slider" data-bs-ride="carousel" class="carousel slide pointer-event">
                                    <ol  class="carousel-indicators">
                                        <li  data-bs-target="#My-Slider" data-bs-slide-to="0" class=""></li>
                                        <li  data-bs-target="#My-Slider" data-bs-slide-to="1" class="active" aria-current="true"></li>
                                        <li  data-bs-target="#My-Slider" data-bs-slide-to="2" class=""></li>
                                    </ol>
                                    <div  role="listbox" class="carousel-inner">
                                        <div  class="carousel-item">
                                            <img  src="{{asset('assets/img/bnr1.webp')}}" class="img-fluid d-none d-sm-block">
                                            <img  src="{{asset('assets/img/bnr1.webp')}}" class="img-fluid d-block d-sm-none">
                                        </div>
                                        <div  class="carousel-item active">
                                            <img  src="{{asset('assets/img/bnr2.webp')}}" class="img-fluid d-none d-sm-block">
                                            <img  src="{{asset('assets/img/bnr2.webp')}}" class="img-fluid d-block d-sm-none">
                                        </div>
                                        <div  class="carousel-item">
                                            <img  src="{{asset('assets/img/bnr3.webp')}}" class="img-fluid d-none d-sm-block">
                                            <img  src="{{asset('assets/img/bnr3.webp')}}" class="img-fluid d-block d-sm-none">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="eventlistdesign">
                                            <h2  class="high-desktop"> &nbsp;&nbsp;  
                                                <ul  class="live_virtual">
                                                    <li >
                                                        <input  type="checkbox" value="Order one" id="checkboxOne-inplay" class="ng-untouched ng-pristine ng-valid">
                                                        <label  for="checkboxOne-inplay">LIVE</label>
                                                    </li>
                                                    <li >
                                                        <input  type="checkbox" value="Order Two" id="checkboxTwo-inplay" class="ng-untouched ng-pristine ng-valid">
                                                        <label  for="checkboxTwo-inplay">VIRTUAL</label>
                                                    </li>
                                                </ul>
                                                <div  class="dropdown viewby-filter">
                                                    <button  type="button" id="ViewBy" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle" fdprocessedid="elfm3n"><i  class="mdi mdi-filter"></i> View by </button>
                                                    <div  aria-bs-labelledby="ViewBy" class="dropdown-menu">
                                                        <a  href="javascript:void(0)">Competition</a>
                                                        <a  href="javascript:void(0)" class="active">Time</a>
                                                    </div>
                                                </div>
                                            </h2>
                                            <h2  class="high-mobile"> &nbsp;&nbsp;  
                                                <ul  class="live_virtual">
                                                    <li >
                                                        <input  type="checkbox" value="Order one" id="checkboxOne-inplay" class="ng-untouched ng-pristine ng-valid">
                                                        <label  for="checkboxOne-inplay">LIVE</label>
                                                    </li>
                                                    <li >
                                                        <input  type="checkbox" value="Order Two" id="checkboxTwo-inplay" class="ng-untouched ng-pristine ng-valid">
                                                        <label  for="checkboxTwo-inplay">VIRTUAL</label>
                                                    </li>
                                                </ul>
                                                <div  class="dropdown viewby-filter">
                                                    <button  type="button" id="ViewBy" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i  class="mdi mdi-filter"></i> View by </button>
                                                    <div  aria-bs-labelledby="ViewBy" class="dropdown-menu">
                                                        <a  href="javascript:void(0)">Competition</a>
                                                        <a  href="javascript:void(0)" class="active">Time</a>
                                                    </div>
                                                </div>
                                            </h2>
                                            <div class="card-body p-0">
                                                <div class="tabcasino">
                                                    <div>
                                                        <tabset class="casino_tabs_ul tab-container">
                                                            <ul class="nav nav-tabs" id="outerTab" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <a class="nav-link active" id="outer-tab-1" data-bs-toggle="tab" data-bs-target="#outer-tab-pane-1" type="button" role="tab" aria-controls="outer-tab-pane-1" aria-selected="true">All</a>
                                                                </li>
                                                                @if(isset($intcasino_events['data']['tables']))
                                                                  @foreach($intcasino_events['data']['tables'] as  $ievents)
                                                                        @foreach($ievents as  $ikey => $ivnt)
                                                                            <li class="nav-item" role="presentation">
                                                                                <a class="nav-link" id="outer-tab-2" data-bs-toggle="tab" data-bs-target="#outer-tab-pane-2" type="button" role="tab" aria-controls="outer-tab-pane-2" aria-selected="false">{{$ikey}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                  @endforeach
                                                                @endif
                                                                
                                                            </ul>
                                                            <div class="tab-content">
                                                                <tab class="tab-pane active" role="tabpanel" aria-labelledby class="tab-pane fade show active" id="outer-tab-pane-1" role="tabpanel" aria-labelledby="outer-tab-1">
                                                                    <div class="icasino_ul_tabs">
                                                                        <tabset class="tab-container">
                                                                            <ul class="nav nav-tabs" id="innerTab1" role="tablist">
                                                                                @if(isset($intcasino_events['data']['tables']))
                                                                                    @foreach($intcasino_events['data']['tables'] as  $subevents)
                                                                                            @foreach($subevents as  $subkey => $sub_event)
                                                                                            {{ dd($subkey)}}
                                                                                                <li class="nav-item" role="presentation">
                                                                                                    <a class="nav-link active" id="inner-tab-1-1" data-bs-toggle="tab" data-bs-target="#inner-tab-pane-1-1" type="button" role="tab" aria-controls="inner-tab-pane-1-1" aria-selected="false">{{$subkey}}</a>
                                                                                                </li>
                                                                                            @endforeach
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </tabset>
                                                                    </div>
                                                                </tab>
                                                            </div>
                                                        </tabset>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="card-body p-0">
                                                <div class="tabcasino">
                                                    <div>
                                                        <tabset class="casino_tabs_ul tab-container">
                                                           
                                                            <div class="tab-content">
                                                                <tab class="tab-pane active" role="tabpanel" aria-labelledby>
                                                                    <div class="icasino_ul_tabs">
                                                                        <tabset class="tab-container">
                                                                            <ul  role="tablist" class="nav nav-tabs" aria-label="Tabs">
                                                                                <li  class="active nav-item">
                                                                                    <a  href="javascript:void(0);" role="tab" class="nav-link active" aria-controls="" aria-selected="true" id="">
                                                                                        <span ></span>
                                                                                        <span  id="childTab-0-0">
                                                                                            <img  class="img-fluid" src="https://tezcdn.com/casino/int-casino-icon/roulette.webp"> roulette 
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li  class="nav-item">
                                                                                    <a  href="javascript:void(0);" role="tab" class="nav-link" aria-controls="" aria-selected="false" id="">
                                                                                        <span ></span>
                                                                                        <span  id="childTab-0-1">
                                                                                            <img  class="img-fluid" src="https://tezcdn.com/casino/int-casino-icon/baccarat.webp"> baccarat 
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                                <li  class="nav-item">
                                                                                    <a  href="javascript:void(0);" role="tab" class="nav-link" aria-controls="" aria-selected="false" id="">
                                                                                        <span ></span>
                                                                                        <span  id="childTab-0-32">
                                                                                            <img  class="img-fluid" src="https://tezcdn.com/casino/int-casino-icon/monopoly.webp"> monopoly 
                                                                                        </span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </tabset>
                                                                    </div>
                                                                </tab>
                                                            </div>
                                                        </tabset>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                        
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
    <!-- Main Content -->
@endsection