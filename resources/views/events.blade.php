@extends('layouts.main')
@section('content')
<div class="container mb-2">
  <!-- Include Sidebar Component -->   
  <!-- Your other content or sections can go here -->
      <div class="row">
            <div class="col-md-2">
                  @include('components.sidebar')
            </div>
            <div class="col-md-7">
                  <div class="marquee-box">
                        <h4 class="marquee-box-h4">News</h4>
                        <marquee>This is a sample scrolling text .</marquee>
                  </div>
                  <div class="row">
                        <div class="col-md-12">
                              <img src="{{asset('assets/img/slider1.webp')}}" alt="" class="img-fluid">
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-12">
                              <div class="event-list">
                                    <h2>hightlights</h2>
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
                                          <div class="tab-content mt-3 event-tab-content" id="myTabContent">
                                                @foreach ($menuData as $menuItem)
                                                      <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }} event-games" id="content-{{ $menuItem['id'] }}" role="tabpanel" aria-labelledby="tab-{{ $menuItem['id'] }}">
                                                            @if (isset($groupedEvents[$menuItem['id']]))
                                                                  <ul>
                                                                        @foreach ($groupedEvents[$menuItem['id']] as $event)
                                                                        <li class="event-games-li">
                                                                              <a href="{{ route('event.details', ['eventId' => $event['event_id']]) }}">
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
            <div class="col-md-3">
                  <div class="open-bets">
                        <h2>Open Bets</h2>
                  </div>
            </div>
      </div>
 </div>


<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

