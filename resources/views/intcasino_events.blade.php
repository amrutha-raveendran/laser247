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
                                                            <ul class="nav nav-tabs" id="parentTab" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                    <a class="nav-link active" id="parent-tab-1" data-bs-toggle="tab" data-bs-target="#parent1"  role="tab" >All</a>
                                                                </li>
                                                                @if(isset($intcasino_events['data']['tables']))
                                                                  @foreach($intcasino_events['data']['tables'] as  $ievents)
                                                                        @foreach($ievents as  $ikey => $ivnt) 
                                                                        
                                                                            <li class="nav-item" role="presentation">
                                                                                <a class="nav-link" id="tab-2-{{str_replace(' ','',$ikey)}}" data-bs-toggle="tab" data-bs-target="#tab2_{{str_replace(' ','',$ikey)}}"  role="tab">{{$ikey}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                  @endforeach
                                                                @endif
                                                            </ul>
                                                            


                                                            <div id="content">
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

                                                                @if(isset($intcasino_events['data']['tables']))
                                                                    @foreach($intcasino_events['data']['tables'] as  $tab2events)
                                                                        @foreach($tab2events as  $tab2key => $tabevent)
                                                                        
                                                                            <tab class="tab-pane fade" id="tab2_{{str_replace(' ','',$tab2key)}}" role="tabpanel" aria-labelledby="tab-2-{{str_replace(' ','',$tab2key)}}">
                                                                                <div class="icasino_ul_tabs">
                                                                                    <div class="tab-container">
                                                                                        <!-- Nested Tabs for Parent Tab 2 -->
                                                                                        <ul class="nav nav-tabs" id="childTab2" role="tablist">
                                                                                            <li class="nav-item" role="presentation">
                                                                                                <a class="nav-link active allgametype" id="taball-{{str_replace(' ','',$tab2key)}}" data-bs-toggle="tab" data-bs-target="#taball-{{str_replace(' ','',$tab2key)}}" type="button" role="tab" aria-controls="taball-{{str_replace(' ','',$tab2key)}}" aria-selected="true">All</a>
                                                                                            </li>
                                                                                            @foreach($tab2events[$tab2key] as $tab2subkey => $tab2subevent)
                                                                                                <li class="nav-item" role="presentation">
                                                                                                    <a class="nav-link gametab" id="subtab-2-{{str_replace(' ','',$tab2key)}}-{{str_replace(' ','',$tab2subkey)}}" data-bs-toggle="tab" data-bs-target="#subtab2-{{str_replace(' ','',$tab2key)}}-{{str_replace(' ','',$tab2subkey)}}" type="button" role="tab" aria-controls="subtab2-{{str_replace(' ','',$tab2key)}}-{{str_replace(' ','',$tab2subkey)}}" aria-selected="false">{{ $tab2subkey}}</a>
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- oldcode -->
                                                                                <div class="tab-content" id="childTabContent2">
                                                                                    <!-- Child Tab 1 Content for Parent Tab 2 -->
                                                                                   
                                                                                    @foreach($tab2events as $typekey=> $allgametypes)
                                                                                        <tab class="tab-pane fade  {{($loop->first)?'show active':''}}" id="taball-{{str_replace(' ','',$typekey)}}" role="tabpanel" aria-labelledby="taball-{{str_replace(' ','',$typekey)}}">
                                                                                            <div class="row py-2 mx-0 justify-content-center">
                                                                                                @foreach($tabevent as $subtab2 =>$secontab)
                                                                                                    @foreach($secontab as $i2events)
                                                                                            
                                                                                                    <div class="col-md-2 col-4 align-self-center text-center">
                                                                                                        <div class="casino position-relative">
                                                                                                            <img src="{{$i2events['url_thumb']}}" class="img-fluid" alt="">
                                                                                                            <a href="" class="btn casino-btn">Play Now</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    @endforeach
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </tab>
                                                                                    @endforeach
                                                                              
                                                                                    <!-- Child Tab 2 Content for Parent Tab 2 -->
                                                                                    @foreach($tab2events[$tab2key] as $tab3subkey => $tab3subevent) 
                                                                                    
                                                                                        <tab class="tab-pane fade" id="subtab2-{{str_replace(' ','',$tab2key)}}-{{str_replace(' ','',$tab3subkey)}}" role="tabpanel" aria-labelledby="subtab-2-{{str_replace(' ','',$tab3subkey)}}-{{str_replace(' ','',$tab2subkey)}}">
                                                                                            <div class="row py-2 mx-0 justify-content-center">
                                                                                                @foreach($tab3subevent as $i3events)
                                                                                                    <div class="col-md-2 col-4 align-self-center text-center">
                                                                                                        <div class="casino position-relative">
                                                                                                            <img src="{{$i3events['url_thumb']}}" class="img-fluid" alt="">
                                                                                                            <a href="" class="btn casino-btn">Play Now</a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </tab>
                                                                                    @endforeach
                                                                                </div>
                                                                                <!-- endcode -->
                                                                            </tab>
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif
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