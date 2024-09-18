<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Car Rental</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{ route('frontend.home') }}" class="navbar-brand">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Car Rental</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('frontend.home') }}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('frontend.about') }}" class="nav-link">About</a>
          </li>
          @guest
          @else
          <li class="nav-item">
            <a href="{{ route('frontend.rental') }}" class="nav-link">Rental History</a>
          </li>
          @endguest
          
          <li class="nav-item">
            <a href="{{ route('frontend.contact') }}" class="nav-link">Contact</a>
          </li>          
          
        </ul>


      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
            </li>
        @else
        <li class="nav-item">
            {{-- <a class="nav-link" href="{{ route('frontend.profile') }}">Profile</a> --}}
            <a class="nav-link" href="#">{{ Auth::user()->email }}</a>
        </li>    
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
          </div>
        </li>



        
        {{-- <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> --}}
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->