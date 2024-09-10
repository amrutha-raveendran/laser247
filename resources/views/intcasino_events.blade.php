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
                                                            <!-- Main Tabs -->
                                                            <ul class="nav nav-tabs" id="mainTab" role="tablist">
                                                                <li class="nav-item  ng-star-inserted" role="presentation">
                                                                    <a class="nav-link active" id="parent-tab-1" data-bs-toggle="tab" data-bs-target="#parent1"  role="tab" >All</a>
                                                                </li>
                                                                @if(isset($intcasino_events['data']['tables']))
                                                                    @foreach($intcasino_events['data']['tables'] as  $ievents)
                                                                        @foreach($ievents as  $ikey => $ivnt) 
                                                                            <li class="nav-item" role="presentation">
                                                                                <a class="nav-link" data-bs-toggle="tab" href="#{{ str_replace(' ','',$ikey)}}" role="tab" aria-controls="{{ str_replace(' ','',$ikey)}}" aria-selected="@if ($loop->first) true @else false @endif">{{ $ikey }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif
                                                            </ul>   
                                                            <!-- Main tabs -->
                                                            <div class="tab-content" id="mainTabContent">
                                                                @foreach($intcasino_events['data']['tables'] as $game_array)
                                                                    @foreach($game_array  as $provider => $games)
                                                                        <div class="tab-pane fade icasino_ul_tabs" id="{{ str_replace(' ','',$provider)}}" role="tabpanel" aria-labelledby="tab-{{ str_replace(' ','',$provider)}}">
                                                                            <!-- Sub Tabs (Games) -->
                                                                            <ul class="nav nav-pills nav-tabs" id="subTab-{{ str_replace(' ','',$provider)}}" role="tablist">
                                                                                <li class="nav-item" role="presentation">
                                                                                    <a class="nav-link active" id="subtab-{{ str_replace(' ','',$provider)}}-all" data-bs-toggle="tab" href="#{{ str_replace(' ','',$provider)}}-all" role="tab" aria-controls="{{ str_replace(' ','',$provider)}}-all" aria-selected="true">All</a>
                                                                                </li>
                                                                                @foreach($games as $game => $details)
                                                                                    <li class="nav-item" role="presentation">
                                                                                        <a class="nav-link" id="subtab-{{ str_replace(' ','',$provider)}}-{{ $game }}" data-bs-toggle="tab" href="#{{ str_replace(' ','',$provider)}}-{{ $game }}" role="tab" aria-controls="{{ str_replace(' ','',$provider)}}-{{ $game }}" aria-selected="false">
                                                                                            {{ ucfirst($game) }}
                                                                                        </a>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                            <!-- Sub Tab Content (Games Content) -->
                                                                            <div class="tab-content mt-3" id="subTabContent-{{ str_replace(' ','',$provider)}}">
                                                                                <!-- "All" Tab Content (Shows All Games for the Provider) -->
                                                                                <div class="tab-pane fade show active" id="{{ str_replace(' ','',$provider)}}-all" role="tabpanel" aria-labelledby="subtab-{{ str_replace(' ','',$provider)}}-all">
                                                                                    
                                                                                    <div class="row py-2 mx-0 justify-content-center">
                                                                                        @foreach($games as $game => $gamealltab)
                                                                                            @foreach($gamealltab as $galltab)
                                                                                                <div class="col-md-2 col-4 align-self-center text-center">
                                                                                                    <div class="casino position-relative">
                                                                                                        <img src="{{$galltab['url_thumb']}}" class="img-fluid" alt="">
                                                                                                        <a href="" class="btn casino-btn">Play Now</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Individual Game Tab Content -->
                                                                                @foreach($games as $game => $gamesubtab)
                                                                                    <div class="tab-pane fade" id="{{ str_replace(' ','',$provider)}}-{{ $game }}" role="tabpanel" aria-labelledby="subtab-{{ $provider }}-{{ $game }}">
                                                                                        <!-- Display game-specific content here -->
                                                                                        <div class="row py-2 mx-0 justify-content-center">
                                                                                            @foreach($gamesubtab as $gsubtab)
                                                                                                <div class="col-md-2 col-4 align-self-center text-center">
                                                                                                    <div class="casino position-relative">
                                                                                                        <img src="{{$gsubtab['url_thumb']}}" class="img-fluid" alt="">
                                                                                                        <a href="" class="btn casino-btn">Play Now</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endforeach
                                                            </div>
                                                            <div id="content" class="tab-content">
                                                                <tab class="tab-pane fade show active" id="parent1" role="tabpanel" aria-labelledby="parent-tab-1">
                                                                    <div class="icasino_ul_tabs">
                                                                        <div class="tab-container">
                                                                            <ul class="nav nav-tabs" id="childTab1" role="tablist">
                                                                                @if(isset($intcasino_events['data']['allTables']))
                                                                                    @foreach($intcasino_events['data']['allTables'] as  $ikey1 => $ievents)
                                                                                        <li class="nav-item {{($loop->first)?' active':''}}" role="presentation">
                                                                                            <a class="nav-link {{($loop->first)?' active':''}}" id="child1-tab-{{$loop->index}}" data-bs-toggle="tab" data-bs-target="#child1-{{$loop->index}}" type="button" role="tab" aria-controls="child1-{{$loop->index}}" aria-selected="true">{{ $ikey1}}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-content" id="childTabContent1">
                                                                        <!-- Child Tab 1 Content -->
                                                                        @if(isset($intcasino_events['data']['allTables']))
                                                                            @foreach($intcasino_events['data']['allTables'] as $skey=> $subevnts)
                                                                                <tab class="tab-pane fade {{($loop->first)?'show active':''}} " id="child1-{{$loop->index}}" role="tabpanel" aria-labelledby="child1-tab-{{$loop->index}}">
                                                                                    <div class="row py-2 mx-0 justify-content-center">
                                                                                        @if(isset($intcasino_events['data']['allTables'][$skey]))
                                                                                            @foreach($intcasino_events['data']['allTables'][$skey] as $ievents)
                                                                                               <div class="col-md-2 col-4 align-self-center text-center">
                                                                                                    <div class="casino position-relative">
                                                                                                        <img src="{{$ievents['url_thumb']}}" class="img-fluid" alt="">
                                                                                                        <a href="" class="btn casino-btn">Play Now</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </div>
                                                                                </tab>
                                                                            @endforeach
                                                                        @endif
                                                                       
                                                                    </div>
                                                                </tab>
                                                                <!-- ---------------------- -->
                                                                
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
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
       $(document).ready(function(){
            $('a.gametab').click(function(e){
                e.preventDefault();
                var id = $(this).attr('id');
                var idval = id.split('-');
                if($(this).hasClass('active')){
                    $('a.allgametype').removeClass('active');
                    $('tab#taball-'+idval[2]).removeClass('active show');
                    
                }
            });
            $('a.allgametype').click(function(e){
                $('tab').removeClass('active');
                var id = $(this).attr('id');
                $('tab#'+id).addClass('active show');
            
            })
            
       })
  </script>
@endsection