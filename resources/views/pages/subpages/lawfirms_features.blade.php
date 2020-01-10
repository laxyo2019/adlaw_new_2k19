@extends("layouts.default")
@section('content')
@include('layouts.hero_section')
<div class="container-fluid container-div">
        <div class="row ">
            <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
                <h2 class="h1-responsive font-weight-bold text-center text-white">LAWYER / LAWFIRMS FEATURES</h2>
                <p class=" ">Perfect CRM Solutions For Lawyer / Law Firms !</p>          
            </div>
        </div>
        <div class="row col-sm-12 col-lg-12 col-xs-12 mb-5">
        	{{-- image div  --}}
        	<div class="col-md-5 ">
        		<img src="{{asset('images/Lawyer-LawFirms.png')}}" style="height:100%; width: 100%;">
        	</div>
        	{{-- content div --}}
        	<div class="col-sm-7 col-lg-7 col-md-7" >
        		
        			<h1 class="font-weight-bold text-captialize mb-5">Consult Best Lawyer / Law Firms in India</h1>
        			<p class="p-text">
                            Seeing the demand of various Legal problems we allow you to hire the professional experts having good experience in Civil Law, Corporate Law, Start-up Solutions, Criminal Law, Consumer Law, Family Law and much more in all over India.
                    <br><br>
                    We help you to consult with the well experienced team of lawyers, researchers & experts carry daily research on all latest current & new law, judgments & Court decisions and allows to hire the best lawyers in India for District Courts, High Court & Supreme Court matters. Our services includes to provide the best legal advisor for legal consultancy services, taxation services, corporate legal services, recovery solutions, financial legal services, bad debt recovery solutions, back office operation services, data entry service, documentation services, passport related services, fiscal documentation etc. 
                    <br><br>
                     
                    </p>

        	
        	</div>
        </div>
        <div class="row">
            <div class="col-md-10 m-auto">
                <p class="p-text">
                     When it comes to businesses, a legal consultant is responsible for providing legal advice and assistance in handling disputes, analyzing and identifying the legal issues, drafting the legal documents, maintaining legal correspondence, etc. If any client is looking for legal advice or legal documentation, Adlaw has the lists of advisors from various states who can help you with just one click. Even our website is meant for those young and energized lawyers who are looking for cases. They have to register them-self on our website providing all documents so that if any clients want to hire you, you will get a notification. Adlaw offers free legal help and advice online for almost any legal matters by our top and best Lawyers in different verticals of Industry.       
                </p>
            </div>
        </div>
</div>

  <section class="border-bottom bg-light" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h2 class="font-weight-bold text-center text-captialize">All Features</h2>
                <span class="span-line mt-4 mb-4"></span>
                    
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-4 my-5">
                 <a href="{{route('features.case_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/case3.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Case Diary Management</h4>
                            
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.client_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/users.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Client Management</h4>
                         
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.calendar_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/calendar.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Calendar Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.document_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/document.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Document Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.appointment_schedule')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/appointment11.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Appointment Schedule Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.agenda_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/agenda2.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Agenda Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.team_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/teams.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Team Members Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.profile_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/profile.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Profile Management</h4>
                           
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.todo_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/todos1.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">To-Dos Management</h4>
                        </div>
                    </div>
                </a>
                </div>

                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.hearing_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/gavel.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Hearing Date Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.schedule_management')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/appointment.png')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Schedule Management</h4>
                        </div>
                    </div>
                </a>
                </div>
                 <div class="col-sm-4 my-5">
                 <a href="{{route('features.chat_or_messanger')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="{{asset('images/icons/chat1.jpg')}}" class="" style="width:80px;">
                            </div>
                            <h4 class="font-weight-bold text-center mt-4">Chat or Messanger</h4>
                        </div>
                    </div>
                </a>
                </div>

            </div>
        </div>
  </section>

@endsection