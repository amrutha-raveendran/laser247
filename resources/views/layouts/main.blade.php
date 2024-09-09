<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous">
    <!--  CSS -->
    <link href="{{ asset('assets/css/app.css')}}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('assets/css/themes.css')}}" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Laser247</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-bg">
      <div class="container-fluid">
        <a class="navbar-brand logo-img" href="{{ route('home')}}">
          <img src="{{ asset('assets/img/logo.gif')}}" alt="" class="logo">
        </a>
        <div class="collapse navbar-collapse navbar-ul" id="navbarSupportedContent">
          <form class="d-flex ms-auto">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input class="form-control me-2" type="text" placeholder="Username" aria-label="Search">
            <input class="form-control me-2" type="password" placeholder="Password" aria-label="Search">
            <button class="btn-login" type="submit">Login</button>
          </form>
          <button class="btn-login">Login with DemoID <i class="fa fa-arrow-right"></i></button>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light menu-navbar topnav">
      <div class="container-fluid">
        <div class="collapse navbar-collapse topnav-div" id="navbarMain">
          <ul class="navbar-nav topnav-ul scroll">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard')}}">In-play</a>
            </li>
            @if(is_array($menus))
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
            @endif
          </ul>
        </div>
      </div>
    </nav>
    @yield('content')
    @yield('scripts')
    <script>
      // Custom scripts
      // Example: Handling menu links with submenus
      var menuLinks = document.querySelectorAll('.menu-link');

      menuLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
          event.preventDefault();
          var parentLi = this.parentElement;
          parentLi.classList.toggle('active');
          menuLinks.forEach(function(otherLink) {
            if (otherLink !== link) {
              otherLink.parentElement.classList.remove('active');
            }
          });
        });
    });


      </script>
     
</body>
</html>
