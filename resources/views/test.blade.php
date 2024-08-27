@extends('layouts.main-demo')
@section('content')
@include('components.side_new')
<div  class="content-page">
      <div  class="content">
            <div  class="container-fluid">
                  <div  class="row">
                        <div  class="col-xl-8 px-lg-1">
                              <div  class="card">
                                 <div  class="card-body p-0">
                                          <div  class="marquee-box">
                                                <h4 ><i  class="mdi mdi-microphone-outline"></i> News </h4>
                                                <marquee  scrollamount="5"></marquee>
                                          </div>
                                          <div  id="My-Slider" data-bs-ride="carousel" class="carousel slide pointer-event">
                                          <ol  class="carousel-indicators">
                                                <li  data-bs-target="#My-Slider" data-bs-slide-to="0" class=""></li>
                                                <li  data-bs-target="#My-Slider" data-bs-slide-to="1" class=""></li>
                                                <li  data-bs-target="#My-Slider" data-bs-slide-to="2" class="active" aria-current="true"></li>
                                          </ol>
                                          <div  role="listbox" class="carousel-inner">
                                                <div  class="carousel-item">
                                                      <img  src="assets/img/bnr1.webp" class="img-fluid d-none d-sm-block">
                                                      <img  src="assets/img/m_bnr1.webp" class="img-fluid d-block d-sm-none">
                                                </div>
                                                <div  class="carousel-item">
                                                      <img  src="assets/img/bnr2.webp" class="img-fluid d-none d-sm-block">
                                                      <img  src="assets/img/m_bnr2.webp" class="img-fluid d-block d-sm-none">
                                                </div>
                                                <div  class="carousel-item active">
                                                      <img  src="assets/img/bnr3.webp" class="img-fluid d-none d-sm-block">
                                                      <img  src="assets/img/m_bnr3.webp" class="img-fluid d-block d-sm-none">
                                                </div>
                                          </div>
                                    </div>
                                    <ul  id="pills-tab" role="tablist" class="nav nav-pills es-tabs-ui">
                                          <li  role="presentation" class="nav-item">
                                                <button  id="pills-exchange-tab" data-bs-toggle="pill" data-bs-target="#pills-exchange" type="button" role="tab" aria-controls="pills-exchange" aria-selected="false" class="nav-link" fdprocessedid="3z2qjo">exchange</button>
                                          </li>
                                          <li  role="presentation" class="nav-item">
                                                <button  id="pills-sportsbook-tab" data-bs-toggle="pill" data-bs-target="#pills-sportsbook" type="button" role="tab" aria-controls="pills-sportsbook" aria-selected="true" class="nav-link active" fdprocessedid="2d04bq">sportsbook</button>
                                          </li>
                                    </ul>
                                    <div  id="pills-tabContent" class="tab-content pt-0">
                                          <div  id="pills-exchange" role="tabpanel" aria-labelledby="pills-exchange-tab" class="tab-pane fade"></div>
                                          <div  id="pills-sportsbook" role="tabpanel" aria-labelledby="pills-sportsbook-tab" class="tab-pane fade active show"></div>
                                    </div>
                                    <div  class="row">
                                          <div  class="col-md-12">
                                                <div  class="eventlistdesign">
                                                      <h2  class="high-desktop"> &nbsp;&nbsp; highlights 
                                                            <ul  class="live_virtual">
                                                                  <li >
                                                                        <input  type="checkbox" value="Order one" id="checkboxOne4-inplay" class="ng-untouched ng-pristine ng-valid">
                                                                        <label  for="checkboxOne4-inplay">LIVE</label>
                                                                  </li>
                                                                  <li >
                                                                        <input  type="checkbox" value="Order Two" id="checkboxTwo4-inplay" class="ng-untouched ng-pristine ng-valid"><label  for="checkboxTwo4-inplay">VIRTUAL</label>
                                                                  </li>
                                                            </ul>
                                                            <div  class="dropdown viewby-filter">
                                                                  <button  type="button" id="ViewBy" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle" fdprocessedid="dzizsm">
                                                                  <i  class="mdi mdi-filter"></i> View by </button>
                                                                  <div  aria-bs-labelledby="ViewBy" class="dropdown-menu">
                                                                        <a  href="javascript:void(0)">Competition</a>
                                                                        <a  href="javascript:void(0)" class="active">Time</a>
                                                                  </div>
                                                            </div>
                                                      </h2>
                                                      <div class="event-list">
                                                            <ul class="nav nav-tabs events-tab" id="myTab" role="tablist">
                                                                  @foreach ($menuData as $menuItem)
                                                                        <li class="nav-item">
                                                                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $menuItem['id'] }}" data-toggle="tab" href="#content-{{ $menuItem['id'] }}" role="tab" aria-controls="content-{{ $menuItem['id'] }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                                              {{ $menuItem['name'] }}
                                                                        </a>
                                                                        </li>
                                                                  @endforeach
                                                            </ul> 
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
                  <div  class="col-xl-4">
                        <div  class="openBets">
                              <div  id="collapseSetting" class="collapse">
                                    <app-stakes  _nghost-mlt-c60="">
                                          <div  style="position: relative;">
                                                <div  class="stakeDiv"><h3 >stake <!----></h3>
                                                <dl  id="" class="setting-block stake-setting">
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd ><input  type="number" class="ng-untouched ng-pristine ng-valid"></dd>
                                                      <dd  class="col-stake_edit">
                                                            <a  href="javascript:;" id="save" class="btn-send ui-link">Save</a>
                                                      </dd>
                                                </dl>
                                          </div>
                                  </div>
                              </div>
                              <h2 >open bets</h2>
                        </div>
                  </div>
            </div>
      </div>
      <nav _ngcontent-mlt-c52="" class="mobile-footer-menu">
            <ul _ngcontent-mlt-c52="">
                  <li _ngcontent-mlt-c52="">
                        <a _ngcontent-mlt-c52="" routerlinkactive="active" href="#/guest/dashboard/4" class="ui-link">
                              <img _ngcontent-mlt-c52="" src="assets/img/trophy.svg" class="icon-sports">Sports
                        </a>
                  </li>
                  <li _ngcontent-mlt-c52="">
                        <a _ngcontent-mlt-c52="" routerlinkactive="active" href="#/guest/inplay" class="ui-link">
                              <img _ngcontent-mlt-c52="" src="assets/img/timer.svg" class="icon-inplay">In-Play
                        </a>
                  </li>
                  <li _ngcontent-mlt-c52="" class="main-nav">
                        <a _ngcontent-mlt-c52="" routerlinkactive="active" href="#/home" routerlink="/home" class="ui-link">
                              <img _ngcontent-mlt-c52="" src="assets/img/home.svg" class="icon-home">Home
                        </a>
                  </li>
                  <li _ngcontent-mlt-c52="">
                        <a _ngcontent-mlt-c52="" routerlinkactive="active" href="#/login" class="ui-link">
                              <img _ngcontent-mlt-c52="" src="assets/img/pin-white-footer.svg" class="icon-pin">Multi Market
                        </a>
                  </li>
                  <li _ngcontent-mlt-c52="">
                        <a _ngcontent-mlt-c52="" routerlinkactive="active" href="javascript:void(0)" class="ui-link">
                              <img _ngcontent-mlt-c52="" src="assets/img/user.svg" class="icon-account">Account
                        </a>
                  </li>
            </ul>
      </nav>
</div>
</div>

             
@endsection

