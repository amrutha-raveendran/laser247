<div class="left-side-menu">
    <div class="h-100">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content" style="padding: 0px;">
                            <div  class="user-box text-center">
                                <div  class="dropdown">
                                    <a  href="javascript: void(0);" data-bs-toggle="dropdown" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block">Geneva Kennedy</a>
                                    <div  class="dropdown-menu user-pro-dropdown"><a  href="javascript:void(0);" class="dropdown-item notify-item"><i  class="fe-user me-1"></i><span >My Account</span></a><a  href="javascript:void(0);" class="dropdown-item notify-item"><i  class="fe-settings me-1"></i><span >Settings</span></a><a  href="javascript:void(0);" class="dropdown-item notify-item"><i  class="fe-lock me-1"></i><span >Lock Screen</span></a><a  href="javascript:void(0);" class="dropdown-item notify-item"><i  class="fe-log-out me-1"></i><span >Logout</span></a></div>
                                </div>
                                <p  class="text-muted">Admin Head</p>
                            </div>
                            <div  id="sidebar-menu">
                           
                         <ul  id="side-menu">
                           
                            @foreach ($menuData as $mkey=>$menuItem)
                            
                              @if($sidebarEvents->has($menuItem['id']))
                                 <li>
                                    <a  data-bs-toggle="collapse" href="#collapse1{{$mkey}}">
                                        <span>{{ $menuItem['name'] }} </span>
                                        <span  class="menu-arrow"></span>
                                    </a> 
                                    <div  class="collapse" id="collapse1{{$mkey}}">
                                    <ul  class="nav-second-level">
                                       @foreach ($sidebarEvents->get($menuItem['id']) as $competitionName => $events)

                                          <li>
                                             <a  data-bs-toggle="collapse" href="#collapse2{{$loop->index + 1}}"> {{ $competitionName}}<span  class="menu-arrow"></span></a>
                                             
                                             <div  class="collapse" id="collapse2{{$loop->index + 1}}">
                                                <ul  class="nav-second-level">
                                                   @foreach ($events as $event)
                                                      <li ><a  href="{{ route('event.details', ['eventId' => $event['event_id']]) }}" class="menu-link-redi">{{ $event['name']}}</a></li>
                                                   @endforeach
                                                </ul>
                                             </div>
                                          
                                          </li>
                                       @endforeach
                                    </ul>
                                    <div>
                                 </li>
                              @endif
                                
                            @endforeach
                           
                         </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>