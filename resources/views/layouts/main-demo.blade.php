<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <!--  CSS -->
    <link href="{{ asset('assets/css/app.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <!-- Laser 24 -->
    <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <link href="{{ asset('assets/css/themes.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <link href="{{ asset('assets/css/login.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <!-- <link href="{{ asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet"  crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Welcome to laser247</title>
  </head>
  <body>
    <div id="wrapper">
        <div id="mainNav" class="navbar-custom">
            <div class="container-fluid">
                <ul  class="list-unstyled topnav-menu float-end mb-0">
                    <li  class="dropdown d-none d-lg-inline-block">
                    <form  novalidate="" class="ng-untouched ng-pristine ng-valid"></form>
                    </li>
                    <li  class="dropdown notification-list topbar-dropdown">
                    <!-- <button  type="button" class="btn btn-login btn-register py-1" style="margin-top: 10px;">demo</button> -->
                    <div  bsmodal="" tabindex="-1" role="dialog" aria-labelledby="dialog-static-name" class="modal fade">
                        <div  class="modal-dialog land-login-modal">
                        <div  class="modal-content">
                            <div  class="modal-header">
                            <h5  id="change-password" class="modal-title pull-left">Change Password</h5>
                            <button  type="button" data-bs-dismiss="modal" aria-label="Close" class="close"><i  class="mdi mdi-close"></i></button>
                            </div>
                            <div  class="modal-body">
                            <div  class="container-fluid">
                                <div  class="row my-1">
                                <div  class="col-md-12">
                                    <div  class="userTables">
                                    <form  novalidate="" class="new-cp-form ng-untouched ng-pristine ng-invalid">
                                        <div  class="row">
                                        <div  class="col-md-6">
                                            <div  class="form-group">
                                            <label  for="" class="text-capitalize font-weight-bold mb-0">old password</label>
                                            <input  type="password" id="" formcontrolname="old_password" class="form-control ng-untouched ng-pristine ng-invalid">
                                            </div>
                                            <div  class="form-group">
                                            <label  for="" class="text-capitalize font-weight-bold mb-0">new password</label>
                                            <input  type="password" formcontrolname="new_password" class="form-control ng-untouched ng-pristine ng-invalid">
                                            </div>
                                            <div  class="form-group">
                                            <label  for="" class="text-capitalize font-weight-bold mb-0">confirm password</label><input  type="password" formcontrolname="new_password_re" class="form-control ng-untouched ng-pristine ng-invalid"><!---->
                                            </div>
                                            <div  class="form-group mt-2">
                                            <button  type="submit" class="btn cp-btn">change password</button>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </li>
                    <li  class="dropdown notification-list topbar-dropdown">
                    <form  novalidate="" class="userloginform ng-untouched ng-pristine ng-invalid">
                        <div  class="row align-items-center">
                        <div  class="col-auto d-flex px-1">
                            <i  class="mdi mdi-account text-light" style="margin-right: 4px; font-size: 17px;"></i><input  type="text" formcontrolname="username" placeholder="Username" class="form-control ng-untouched ng-pristine ng-invalid"><!---->
                        </div>
                        <div  class="col-auto px-0">
                            <div  class="input-group">
                            <input  type="password" formcontrolname="password" placeholder="Passsword" class="form-control ng-untouched ng-pristine ng-invalid"><!---->
                            </div>
                        </div>
                        <div  class="col-auto px-1">
                            <button  type="submit" class="btn btnlogin">Login <i  class="mdi mdi-arrow-right"></i></button>
                            <button  type="button" class="btn btnlogin">Login with Demo ID <i  class="mdi mdi-arrow-right"></i></button>
                        </div>
                        </div>
                    </form>
                    <div  bsmodal="" tabindex="-1" role="dialog" aria-labelledby="dialog-static-name" class="modal fade">
                        <div  class="modal-dialog land-login-modal">
                        <div  class="modal-content">
                            <div  class="modal-header">
                            <h5  id="change-password" class="modal-title pull-left">Change Password</h5>
                            <button  type="button" data-bs-dismiss="modal" aria-label="Close" class="close"><i  class="mdi mdi-close"></i></button>
                            </div>
                            <div  class="modal-body">
                            <div  class="container-fluid">
                                <div  class="row my-1">
                                <div  class="col-md-12">
                                    <div  class="userTables">
                                    <form  novalidate="" class="new-cp-form ng-untouched ng-pristine ng-invalid">
                                        <div  class="row">
                                        <div  class="col-md-6">
                                            <div  class="form-group">
                                            <label  for="" class="text-capitalize font-weight-bold mb-0">old password</label><input  type="password" id="" formcontrolname="old_password" class="form-control ng-untouched ng-pristine ng-invalid"><!---->
                                            </div>
                                            <div  class="form-group">
                                            <label  for="" class="text-capitalize font-weight-bold mb-0">new password</label><input  type="password" formcontrolname="new_password" class="form-control ng-untouched ng-pristine ng-invalid"><!---->
                                            </div>
                                            <div  class="form-group">
                                            <label  for="" class="text-capitalize font-weight-bold mb-0">confirm password</label><input  type="password" formcontrolname="new_password_re" class="form-control ng-untouched ng-pristine ng-invalid"><!---->
                                            </div>
                                            <div  class="form-group mt-2">
                                            <button  type="submit" class="btn cp-btn">change password</button>
                                            </div>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <button  type="button" class="btn btn-login py-1" style="margin-top: 16px;">
                        <i  class="mdi mdi-account"></i> Login
                    </button>
                    </li>
                    <li  class="dropdown notification-list topbar-dropdown"></li>
                    <li  class="dropdown notification-list topbar-dropdown"></li>
                </ul>
                <div  class="logo-box">
                    <a  href="{{ route('home')}}" class="logo logo-light text-center">
                    <span  class="logo-sm"><img  alt="" src="{{ asset('assets/img/logo.gif')}}"></span>
                    <span  class="logo-lg"><img  alt="" class="img-fluid" src="{{ asset('assets/img/logo.gif')}}"></span>
                    </a>
                </div>
                <ul  class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li >
                        <a  data-bs-toggle="collapse" data-bs-target="#topnav-menu-content" class="navbar-toggle nav-link">
                            <div  class="lines"><span ></span><span ></span><span ></span></div>
                        </a>
                    </li>
                </ul>
                <div  class="clearfix"></div>
            </div>
        </div>
        <div class="topnav">
            <div class="container-fluid px-0">
                <nav  class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div  id="topnav-menu-content" class="collapse navbar-collapse">
                    <ul  class="navbar-nav">
                        <li  class="nav-item"><a  href="{{route('dashboard')}}" routerlinkactive="active">home</a></li>
                        <li  class="nav-item"><a  href="{{ route('events.inplay')}}" routerlinkactive="active">in-play</a></li>
                        @if(isset($menus['evnt_list']['data']['menu']) && is_array($menus['evnt_list']['data']['menu']))
                        @foreach($menus['evnt_list']['data']['menu'] as $menuItem)
                            @if(isset($menuItem['name']) )
                                <li class="nav-item">
                                <a href="{{ route('events.sports', ['sportId' => $menuItem['id']]) }}" class="nav-link {{($menuItem['id'] =='99995'||$menuItem['id']=='99999')?'hightlight-menus':(($menuItem['id']=='99991')?'rc-menu':'')}}" href="" >
                                    {{ $menuItem['name'] }}<sup class="sup-animated">{{($menuItem['id']=='99991' || $menuItem['id']=='99990')?'NEW':''}}</sup>
                                </a>
                                </li>
                            @else
                                <li class="nav-item">
                                <span class="nav-link">Menu item data is incomplete.</span>
                                </li>
                            @endif
                        @endforeach
                        @endif
                    </ul>
                    </div>
                </nav>
            </div>
        </div>
    
      @yield('content')
      @yield('scripts')
      <script>
        // Select all menu links with submenus
          var menuLinks = document.querySelectorAll('.menu-link');
        // Loop through each menu link and attach a click event listener
        menuLinks.forEach(function(link) {
          link.addEventListener('click', function(event) {
            // Prevent default action
            event.preventDefault();
            // Get the parent <li> element
            var parentLi = this.parentElement;
            // Toggle the active class on the parent <li>
            parentLi.classList.toggle('active');
            // Close other open submenus if needed
            menuLinks.forEach(function(otherLink) {
                  if (otherLink !== link) {
                      otherLink.parentElement.classList.remove('active');
                  }
              });
          });
        });
      </script>
      <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    </div>
  </body>
</html>