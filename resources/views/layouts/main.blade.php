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
    <!-- <link href="{{ asset('assets/css/bootstrap-icons.css')}}" rel="stylesheet"  crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


     

    <title>Laser247</title>
  </head>
<nav class="navbar navbar-expand-lg navbar-light navbar-bg">
  <div class="container-fluid">
    <a class="navbar-brand logo-img" href="#">
        <img src="{{ asset('assets/img/logo.gif')}}" alt="" class="logo">
    </a>
    <div class="collapse navbar-collapse navbar-ul" id="navbarSupportedContent">
      
      <form class="d-flex ms-auto">
        <span class="input-group-text"><i class="fas fa-user"></i></span>
        <input class="form-control me-2" type="text" placeholder="Username" aria-label="Search">
        <input class="form-control me-2" type="password" placeholder="Password" aria-label="Search">
        <button class="btn-login" type="submit">Login </button>
      </form>
      <button class="btn-login"> Login with DemoID  <i class="fa fa-arrow-right"></i></button>
      
  
    </div>
  </div>
</nav>
<body>
@yield('content')
</body>
</html>