@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container container-div ">
    <div class="row ">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase text-white">Daily Service Report Management</h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="p-text">
        		Daily Service Report Management allows the lawyers/law firms to assign priorities, build momentum, collaborate without confusions and ensure that action steps are taken on time, every time. They are also essential to manage work overload effectively, helping you and your team members stay focused and organized. Beyond the cases, Daily Service Report help in strengthening the efficiency of day-to-day firm operations while also positively influencing individual productivity. They play an important role in enabling lawyers and law firms to produce the results they seek. 

        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4 ">
                    <img src="{{asset('images/dashboard/agenda.png')}}" class="w-100 h-100">
                </div>

                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                In this feature you can Create any number of Daily Service Report, Link tasks to cases, Set calendar deadlines, Assign tasks to team members, View pending, upcoming and completed tasks, Set email and/or SMS reminders to your own frequencies for the exact alerts you want and Edit or delete tasks as needed.
                    <ul class="feature_ul mt-4">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Manage your Daily Service Report</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Crearte any number of Daily Service Report</li> 
                         <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">Daily Service Report used for as attendance purpose.</li> 

                    </ul>

                </div>
            </div>
            <div class="row">                
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                     In this feature you can submit your Daily Service Report. you can also show your today Daily Service Report and overall Daily Service Report
                    <ul class="feature_ul mt-4">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">You can also confirmed appointment</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">You can see unconfirmed appointment</li> 
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}">You can also cancelled appointment</li> 
                    </ul>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4 ">
                    <img src="{{asset('images/dashboard/agenda1.png')}}" class="w-100 h-100">
                </div>
            </div>
            <p class="p-text mt-4">
            
            </p>


        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 mb-5">
            <a href="{{route('features.appointment_schedule')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('features.team_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection