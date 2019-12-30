@extends("layouts.default")
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2">
            <h2 class="h1-responsive font-weight-bold text-center text-uppercase my-4">Course and Batch Management</h2>          
        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 feature-p-text">
        	{{-- <h4 class="text-uppercase font-weight-bold">CASE MANAGEMENT</h4> --}}
        	<p class="text-justify">
        		Course and Batch Management feature offered by adlaw is designed for law colleges where they manage batch of students and courses what they provide. This includes the list of all law courses offering by the law colleges. The course name, qualification name, course duration, and syllabus can be added by law colleges. Students can find relevant course, course duration and see the syllabus offered by law colleges. 
        	</p>

             <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 col-xl-5 mt-4">
                    <img src="{{asset('images/dashboard/course.png')}}" class="w-100 h-100">
                </div>
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 col-xl-7 mt-4">
                    <ul class="feature_ul ">
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Add any number of clients easily</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Easily maintain Indiviual and Corporate Client</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Client related cases maintain</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Client related cases maintain</li>
                        <li><img class="mr-2" src="{{asset('images/dashboard/list-style-image.png')}}"> Client related cases maintain</li>
                    </ul>
                </div>
            </div>
            <p class="text-justify mt-4">
                 The batches can be filtered by batch name, start date, end date where the college management can manage the batches by adding new and update existing. The details can be searched by the course name and qualification name from the search box. 
            </p>


        </div>
        <div class="col-sm-12 col-lg-12 col-xs-12 mt-4 ">
            <a href="{{route('lawschools.agenda_management')}}" class="btn btn-md bg-info pull-left text-white"><i class="fa fa-angle-left"></i></a>
            <a href="{{route('lawschools.profile_management')}}" class="btn btn-md bg-info pull-right text-white"><i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</div>
@endsection