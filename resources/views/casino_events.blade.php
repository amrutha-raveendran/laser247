@extends('layouts.main-demo')
@section('content')
    <!-- Sidebar -->
    @include('components.side_new')
    <!-- Sidebar -->
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
                                            <div  class="row py-2 mx-0 justify-content-center">
                                                @if(isset($casino_events))
                                                    @foreach($casino_events as $casino)
                                                        <div  class="col-md-2 col-4 align-self-center text-center csn-col mb-1">
                                                            <div  class="casino position-relative">
                                                                <img  class="img-fluid" src="{{$casino['imgUrl']}}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="row mobile-hide">
                              <div  class="col-md-12">
                                    <div  class="inner-footer">
                                          <div  class="support-wrap">
                                                <dl  class="support-mail">
                                                      <a  class="rules-btn-home">Privacy Policy</a>
                                                      <a  class="rules-btn-home arrow">KYC</a>
                                                      <a  class="rules-btn-home arrow">Terms and Conditions</a>
                                                      <a  class="rules-btn-home arrow">Rules and Regulations</a>
                                                      <a  class="rules-btn-home arrow">Responsible Gambling</a>
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