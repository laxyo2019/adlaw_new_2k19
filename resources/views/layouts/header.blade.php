<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <title>Adlaw</title> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="yandex-verification" content="8f0c9478d0aaca4e" />
    <link rel="canonical" href="https://www.adlaw.in/"/>
    <meta name="google-site-verification" content="2iDNtR3LqBEDPUP45mwIXtE6a1XdOf7y9cz8TRGqxB0" />
    <title>@yield('title','ADLAW')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('title','ADLAW')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="http://www.adlaw.in/" />
    <meta property="og:site_name" content="Adlaw" />
    <link rel = "icon" href ="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" type = "image/x-icon" style="line-height: 40px;">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/topbar.css') }}" />

    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/find_city_lawyer.css') }}" /> 
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/find_research_platform.css') }}" />
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/footer.css') }}" />
    <link rel = "stylesheet" type = "text/css" href ="{{ asset('css/lawyer_profile_backup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/star-rating-svg.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard/search_all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dashboard/btn-social.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    {{-- <link rel="stylesheet" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"> --}}
    
    <link href="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.css" rel="stylesheet"/>
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-48209472-2"></script>

</head>
<style type="text/css">
  .carousel-item {
  /*height: 100vh;*/
  min-height: 500px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.customNav li a {
    font-size: 14px;
}
.ped-4{
    padding: 0.92rem !important;
}
.display-4{
  font-family: "Segoe UI",Arial,sans-serif !important;
  color : white !important;
}

.carousel-caption {
  position: absolute;
  right: 15%;
  bottom: 20px;
  left: 15%;
  z-index: 10;
  padding-top: 10px;
  padding-bottom: 60px !important;
  color: #fff;
  text-align: center;
}
.carousel-caption h2 p{
  margin-top: 2.0rem !important;
}
.img-photo{
width: 33px; height: 29px;
}
#logout-form{
 display: none;
}
.login-dropdown{
left:-45px;
}
</style>

<body>
  <nav class="navbar navbar-expand-xl menunav p-0 fixed-top" >
  <div class="container-fluid">
      <a class="navbar-header" href="{{url('/')}}" style="padding:10px 0px 10px 0px !important"><img src="{{asset('images/adlaw-logo.png')}}" alt="Adlaw" style="width: 90px;"></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon text-white'"><i class="fa fa-bars" aria-hidden="true"></i></span>
      </button>
    <div class="collapse navbar-collapse " id="collapsibleNavbar">
        <ul class="nav navbar-nav ml-auto customNav">
            <li class="nav-item {{Request()->segment(1) == '' ? 'active_class' : '' }}">
                <a href="{{route('/')}}"  class="nav-link ped-4">HOME</a>
            </li> 
            <li class="nav-item dropdown ">
                <a class="ped-4 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  ABOUT
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('about_us')}}">ABOUT</a>
                  <a class="dropdown-item" href="{{route('why_adlaw')}}">Why ADLAW?</a>
                </div>
              </li>
              <li class="nav-item">
                  <a href="{{route('faqs')}}"  class="nav-link ped-4">FAQs</a>
              </li> 

              <li class="nav-item dropdown">
                <a class="ped-4 nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  SERVICES
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('lawfirms')}}">LAWYERS/LAW FIRMS</a>
                  <a class="dropdown-item" href="{{route('search')}}">COMPANY/OTHER LAW USERS</a>
                  <a class="dropdown-item" href="{{route('lawschools')}}">LAW SCHOOLS/STUDENTS</a>
                </div>
              </li>

           {{--  <li class="nav-item {{Request()->segment(1) == 'about-us' ? 'active_class' : '' }}">
                <a href="{{route('about_us')}}"  class="ped-4 nav-link" >ABOUT</a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a href="#" class="nav-link p-3">Why ADLAW?</a></li>
                    <li class="nav-item"><a href="#" class="nav-link p-3">More</a></li>
                </ul>
            </li>
            <li class="nav-item {{Request()->segment(1) == 'why-adlaw' ? 'active_class' : '' }}">
                <a href="{{route('why_adlaw')}}"  class="nav-link ped-4">WHY ADLAW</a>
            </li> --}}
         {{--    <li class="nav-item {{Request()->segment(2) == 'lawfirms' ? 'active_class' : '' }}">
                <a class="nav-link ped-4 " href="{{route('lawfirms')}}">LAWYERS/LAW FIRMS </a>
            </li>

            <li class="nav-item {{Request()->segment(2) == 'search' ? 'active_class' : '' }} ">
                <a class="nav-link ped-4" href="{{route('search')}}">COMPANY/OTHER LAW USERS</a>
            </li>
            <li class="nav-item {{Request()->segment(2) == 'lawschools' ? 'active_class' : '' }} ">
                <a class="nav-link ped-4" href="{{route('lawschools')}}">LAW SCHOOLS/STUDENTS</a>
            </li> --}}
            <li class="nav-item {{Request()->segment(1) == 'contact' ? 'active_class' : '' }}">
                <a href="{{route('contact.index')}}" class="nav-link ped-4">CONTACT</a>
            </li> 
            @guest
            <li class="nav-item">
                <a href="{{route('login')}}" class="nav-link ped-4">LOGIN</a>
            </li>
            @endguest

            @guest
            <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link ped-4">REGISTER</a>
            </li>
            @endguest

            @if(Auth::user())
            <li class="nav-item dropdown ">
              <a class="dropdown-toggle nav-link ped-4" href="{{route('register')}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::user()->photo !='')
                <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}"  style="width: 33px; height: 29px;" class="" />
                @else
                <img src="{{asset('storage/profile_photo/default.png')}}"  style="width: 33px; height: 29px;" class="rounded-circle" />
                @endif
              </a>
              <ul class="dropdown-menu " style=" left:-45px;
">
                <li class="nav-item">
                  <a class="nav-link p-3 text-dark"  href="{{route('login')}}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link p-3 text-dark" href="#">{{ __('Messages') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link p-3 text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
              </ul>
            </li>
            @endif
            </ul>
        </div> 
    </div>
  </nav>
