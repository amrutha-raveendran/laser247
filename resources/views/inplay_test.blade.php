@extends('layouts.main')

@section('content')
<!-- Content -->
<div  class="content-page inPlay">
    <div  class="content">
        <div  class="container-fluid"><router-outlet
                ></router-outlet><app-in-play _nghost-lkv-c84="">
                <div  class="row">
                    <div  class="col-xl-8 px-lg-1">
                        <div  id="My-Slider" data-bs-ride="carousel"
                            class="carousel slide pointer-event">
                            <ol  class="carousel-indicators">
                                <li  data-bs-target="#My-Slider" data-bs-slide-to="0"
                                    class="active" aria-current="true"></li>
                                <li  data-bs-target="#My-Slider" data-bs-slide-to="1" class="">
                                </li>
                                <li  data-bs-target="#My-Slider" data-bs-slide-to="2" class="">
                                </li>
                            </ol>
                            <div  role="listbox" class="carousel-inner">
                                <div  class="carousel-item active"><img 
                                        src="assets/img/bnr1.webp" class="img-fluid d-none d-sm-block"><img
                                         src="assets/img/m_bnr1.webp"
                                        class="img-fluid d-block d-sm-none"></div>
                                <div  class="carousel-item"><img 
                                        src="assets/img/bnr2.webp" class="img-fluid d-none d-sm-block"><img
                                         src="assets/img/m_bnr2.webp"
                                        class="img-fluid d-block d-sm-none"></div>
                                <div  class="carousel-item"><img 
                                        src="assets/img/bnr3.webp" class="img-fluid d-none d-sm-block"><img
                                         src="assets/img/m_bnr3.webp"
                                        class="img-fluid d-block d-sm-none"></div>
                            </div>
                        </div>
                        <ul  id="pills-tab" role="tablist" class="nav nav-pills es-tabs-ui">
                            <li  role="presentation" class="nav-item"><button 
                                    id="pills-exchange-tab" data-bs-toggle="pill" data-bs-target="#pills-exchange"
                                    type="button" role="tab" aria-controls="pills-exchange" aria-selected="true"
                                    class="nav-link active" fdprocessedid="o1c12c">exchange</button></li>
                            <li  role="presentation" class="nav-item"><button 
                                    id="pills-sportsbook-tab" data-bs-toggle="pill" data-bs-target="#pills-sportsbook"
                                    type="button" role="tab" aria-controls="pills-sportsbook" aria-selected="false"
                                    class="nav-link" fdprocessedid="bbz86">sportsbook</button></li>
                        </ul>
                        
                        <div  id="pills-tabContent" class="tab-content pt-0">
                            <div  id="pills-exchange" role="tabpanel"
                                aria-labelledby="pills-exchange-tab" class="tab-pane fade show active"></div>
                            <div  id="pills-sportsbook" role="tabpanel"
                                aria-labelledby="pills-sportsbook-tab" class="tab-pane fade"></div>
                        </div>
                        <div  class="inplay">
                            <tabset  type="pills navtab-bg" class="tab-container">
                                <ul class="nav nav-tabs nav-pills" id="eventTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="inplay-tab" data-bs-toggle="tab" href="#inplay" role="tab" aria-controls="inplay" aria-selected="true">In-Play</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="today-tab" data-bs-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="false">Today</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tomorrow-tab" data-bs-toggle="tab" href="#tomorrow" role="tab" aria-controls="tomorrow" aria-selected="false">Tomorrow</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <a  class="mobile-search-btn">
                                        <img  src="assets/img/icon-searching.svg" class="img-fluid">
                                    </a>
                                    
    
                                    <tab role="tabpanel" aria-labelledby="tab0-link" id="inplay" class="tab-pane active">
            @foreach($groupedEvents['In-Play'] as $eventTypeName => $events)
                <div>
                    <div class="mb-1">
                        <h2>{{ $eventTypeName }}
                            <ul class="live_virtual">
                                <li>
                                    <input type="checkbox" value="Order one" id="checkboxOne4-In-Play" class="ng-untouched ng-pristine ng-valid">
                                    <label for="checkboxOne4-In-Play">LIVE</label>
                                </li>
                                <li>
                                    <input type="checkbox" value="Order Two" id="checkboxTwo4-In-Play" class="ng-untouched ng-pristine ng-valid">
                                    <label for="checkboxTwo4-In-Play">VIRTUAL</label>
                                </li>
                            </ul>
                        </h2>
                        <div class="row oneX2">
                            <div class="col-md-5"></div>
                            <div class="col-md-6 px-lg-0">
                                <div class="oddsEventlist">
                                    <div class="btn-group">
                                        <span>1</span>
                                    </div>
                                    <div class="btn-group">
                                        <span>X</span>
                                    </div>
                                    <div class="btn-group">
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        @foreach($events as $event)
                            @php
                                $marketId = $event['market_id'];
                                $marketDataString = $rows['rows'][$marketId] ?? '';
                                $values = [];

                                // Check if marketDataString is not empty before processing
                                if (!empty($marketDataString)) {
                                    $data = explode('|', $marketDataString);
                                    $values = [
                                        $data[12] ?? '',
                                        $data[16] ?? '',
                                        $data[25] ?? '',
                                        $data[42] ?? ''
                                    ];
                                }
                            @endphp
                            <div class="row align-items-center row-my">
                                <div class="col-md-5 px-1 col-10">
                                    <p class="matchname">
                                        <a class="item-inplay" href="{{ route('event.details', $event['event_id']) }}">
                                            <img src="assets/img/icon-in_play.png" class="img-fluid"> {{ $event['name'] }} ({{ $event['competition_name'] }})
                                        </a>
                                        <b>
                                            <span class="in_play">In-Play</span>
                                            <span class="game-bm"><img src="assets/img/icon-bookmaker.svg" class="img-fluid"></span>
                                            <span class="timer-on">{{ \Carbon\Carbon::parse($event['open_date'])->format('H:i') }} </span>
                                        </b>
                                    </p>
                                </div>
                                <div class="col-md-6 col px-0">
                                    <div class="oddsEventlist">
                                        <div class="btn-group">
                                            <button class="back">- </button><button class="lay">-</button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="back">-</button><button class="lay">-</button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="back">-</button><button class="lay">-</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-2 text-end text-lg-center"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </tab>

        <tab role="tabpanel" aria-labelledby="tab0-link" id="today" class="tab-pane">
            @foreach($groupedEvents['Today'] as $eventTypeName => $events)
                <div>
                    <div class="mb-1">
                        <h2>{{ $eventTypeName }}
                            <ul class="live_virtual">
                                <li>
                                    <input type="checkbox" value="Order one" id="checkboxOne4-Today" class="ng-untouched ng-pristine ng-valid">
                                    <label for="checkboxOne4-Today">LIVE</label>
                                </li>
                                <li>
                                    <input type="checkbox" value="Order Two" id="checkboxTwo4-Today" class="ng-untouched ng-pristine ng-valid">
                                    <label for="checkboxTwo4-Today">VIRTUAL</label>
                                </li>
                            </ul>
                        </h2>
                        <div class="row oneX2">
                            <div class="col-md-5"></div>
                            <div class="col-md-6 px-lg-0">
                                <div class="oddsEventlist">
                                    <div class="btn-group">
                                        <span>1</span>
                                    </div>
                                    <div class="btn-group">
                                        <span>X</span>
                                    </div>
                                    <div class="btn-group">
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        @foreach($events as $event)
                            @php
                                $marketId = $event['market_id'];
                                $marketDataString = $rows['rows'][$marketId] ?? '';
                                $values = [];

                                // Check if marketDataString is not empty before processing
                                if (!empty($marketDataString)) {
                                    $data = explode('|', $marketDataString);
                                    $values = [
                                        $data[12] ?? '',
                                        $data[16] ?? '',
                                        $data[25] ?? '',
                                        $data[42] ?? ''
                                    ];
                                }
                            @endphp
                            <div class="row align-items-center row-my">
                                <div class="col-md-5 px-1 col-10">
                                    <p class="matchname">
                                        <a class="item-inplay" href="{{ route('event.details', $event['event_id']) }}">
                                            <img src="assets/img/icon-in_play.png" class="img-fluid"> {{ $event['name'] }} ({{ $event['competition_name'] }})
                                        </a>
                                        <b>
                                            <span class="in_play">In-Play</span>
                                            <span class="game-bm"><img src="assets/img/icon-bookmaker.svg" class="img-fluid"></span>
                                            <span class="timer-on">{{ \Carbon\Carbon::parse($event['open_date'])->format('H:i') }} </span>
                                        </b>
                                    </p>
                                </div>
                                <div class="col-md-6 col px-0">
                                    <div class="oddsEventlist">
                                        <div class="btn-group">
                                            <button class="back">- </button><button class="lay">-</button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="back">-</button><button class="lay">-</button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="back">-</button><button class="lay">-</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-2 text-end text-lg-center"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </tab>

        <tab role="tabpanel" aria-labelledby="tab0-link" id="tomorrow" class="tab-pane">
            @foreach($groupedEvents['Tomorrow'] as $eventTypeName => $events)
                <div>
                    <div class="mb-1">
                        <h2>{{ $eventTypeName }}
                            <ul class="live_virtual">
                                <li>
                                    <input type="checkbox" value="Order one" id="checkboxOne4-Tomorrow" class="ng-untouched ng-pristine ng-valid">
                                    <label for="checkboxOne4-Tomorrow">LIVE</label>
                                </li>
                                <li>
                                    <input type="checkbox" value="Order Two" id="checkboxTwo4-Tomorrow" class="ng-untouched ng-pristine ng-valid">
                                    <label for="checkboxTwo4-Tomorrow">VIRTUAL</label>
                                </li>
                            </ul>
                        </h2>
                        <div class="row oneX2">
                            <div class="col-md-5"></div>
                            <div class="col-md-6 px-lg-0">
                                <div class="oddsEventlist">
                                    <div class="btn-group">
                                        <span>1</span>
                                    </div>
                                    <div class="btn-group">
                                        <span>X</span>
                                    </div>
                                    <div class="btn-group">
                                        <span>2</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        @foreach($events as $event)
                            @php
                                $marketId = $event['market_id'];
                                $marketDataString = $rows['rows'][$marketId] ?? '';
                                $values = [];

                                // Check if marketDataString is not empty before processing
                                if (!empty($marketDataString)) {
                                    $data = explode('|', $marketDataString);
                                    $values = [
                                        $data[12] ?? '',
                                        $data[16] ?? '',
                                        $data[25] ?? '',
                                        $data[42] ?? ''
                                    ];
                                }
                            @endphp
                            <div class="row align-items-center row-my">
                                <div class="col-md-5 px-1 col-10">
                                    <p class="matchname">
                                        <a class="item-inplay" href="{{ route('event.details', $event['event_id']) }}">
                                            <img src="assets/img/icon-in_play.png" class="img-fluid"> {{ $event['name'] }} ({{ $event['competition_name'] }})
                                        </a>
                                        <b>
                                            <span class="in_play">In-Play</span>
                                            <span class="game-bm"><img src="assets/img/icon-bookmaker.svg" class="img-fluid"></span>
                                            <span class="timer-on">{{ \Carbon\Carbon::parse($event['open_date'])->format('H:i') }} </span>
                                        </b>
                                    </p>
                                </div>
                                <div class="col-md-6 col px-0">
                                    <div class="oddsEventlist">
                                        <div class="btn-group">
                                            <button class="back">- </button><button class="lay">-</button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="back">-</button><button class="lay">-</button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="back">-</button><button class="lay">-</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-2 text-end text-lg-center"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </tab>

        <div  class="col-xl-4">
                        <div  class="openBets">
                            <h2 >open bets</h2>
                        </div>
                    </div>
    </div>

@endsection

@section('scripts')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
