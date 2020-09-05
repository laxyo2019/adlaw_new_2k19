@extends("layouts.default")

@section('title','Top Lawyers, Law Firm Portal | Find a Lawyer, Legal Advisor | Lawyers Ranking in India, | Adlaw')
@section('description','Adlaw is a Lawyer and Firm Portal where you can find a lawyer, legal advisor and law ranking at all locations around India.')
@section('keywords', 'find a lawyer, lawyers portal India, find legal advisor, Best Lawyers in India, top lawyers, law firm portal, top lawyers in India, lawyers ranking in India')

@section('content')
  <nav class="navbar navbar-expand-xl menunav p-0 fixed-top">
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
                  <a class="dropdown-item" href="{{route('guest')}}">COMPANY/OTHER LAW USERS</a>
                  <a class="dropdown-item" href="{{route('lawschools')}}">LAW SCHOOLS/STUDENTS</a>
                </div>
              </li>
             {{-- <li class="nav-item dropdown {{Request()->segment(1) == 'about-us' ? 'active_class' : '' }}">
                <a href="#"  class="ped-4 nav-link dropdown-toggle" href="#" id="navbarDropdown"  >ABOUT</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">>
                    <li class="nav-item"><a href="#" class="nav-link p-3">ABOUT</a></li>
                    <li class="nav-item"><a href="#" class="nav-link p-3">Why ADLAW?</a></li>
                </ul>
            </li> --}}
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
        {{--     <li class="nav-item {{Request()->segment(2) == 'lawfirms' ? 'active_class' : '' }}">
                <a class="nav-link ped-4 " href="{{route('lawfirms')}}">LAWYERS/LAW FIRMS </a>
            </li>

            <li class="nav-item {{Request()->segment(2) == 'guest' ? 'active_class' : '' }} ">
                <a class="nav-link ped-4" href="{{route('guest')}}">COMPANY/OTHER LAW USERS</a>
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
                <img src="{{ asset('storage/profile_photo/'.Auth::user()->photo)}}" class="img-photo" />
                @else
                <img src="{{asset('storage/profile_photo/default.png')}}"  class="img-photo rounded-circle" />
                @endif
              </a>
              <ul class="dropdown-menu login-dropdown" >
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
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                </form>
              </ul>
            </li>
            @endif
            </ul>
        </div> 
    </div>
  </nav>

@include('layouts.slider')
@include('pages.features.category')
@include('pages.features.lawfirms')
@include('pages.features.guest')
@include('pages.features.lawschools')
{{-- @include('layouts.footer') --}}
@endsection