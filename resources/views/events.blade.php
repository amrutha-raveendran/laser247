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
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="row">                                       
                                                <div class="col-12">
                                                      <div class="event-list eventlistdesign">
                                                            <div class="evnts-nav-pills">
                                                                  <ul class="nav nav-tabs events-tab" id="myTab" role="tablist">
                                                                        @foreach ($menuData as $menuItem)
                                                                              <li class="nav-item">
                                                                              <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $menuItem['id'] }}" data-toggle="tab" href="#content-{{ $menuItem['id'] }}" role="tab" aria-controls="content-{{ $menuItem['id'] }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                                                    {{ $menuItem['name'] }}
                                                                              </a>
                                                                              </li>
                                                                        @endforeach
                                                                  </ul> 
                                                                  <div class="asxr"></div>
                                                                  <div class="tab-content  event-tab-content  mt-3" id="myTabContent">
                                                                              @foreach ($menuData as $menuItem)
                                                                              <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }} event-games" id="content-{{ $menuItem['id'] }}" role="tabpanel" aria-labelledby="tab-{{ $menuItem['id'] }}">
                                                                                    @if (isset($groupedEvents[$menuItem['id']]))
                                                                                          <ul>
                                                                                                @foreach ($groupedEvents[$menuItem['id']] as $event)
                                                                                                <li class="event-games-li">
                                                                                                      <a href="{{ route('event.details', ['eventId' => $event['event_id']]) }}">
                                                                                                            @if ($event['in_play'])
                                                                                                                  <img src="assets/img/icon-in_play.png" class="img-fluid">
                                                                                                            @else
                                                                                                                  <img src="assets/img/icon-no_play.png" class="img-fluid">
                                                                                                            @endif
                                                                                                            {{ $event['name'] }}
                                                                                                            @if ($event['in_play'])
                                                                                                            <span class="in-play">In Play</span>
                                                                                                            @endif
                                                                                                      </a>
                                                                                                </li>
                                                                                                @endforeach
                                                                                          </ul>
                                                                                    @else
                                                                                          <p>No events available for this category.</p>
                                                                                    @endif
                                                                              </div>
                                                            @endforeach
                                                                  </div>
                                                            </div> 
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>

                        </div>
                        @include('components.bet_sidebar')
                  </div>
            </div>
      </div>
</div>
<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

