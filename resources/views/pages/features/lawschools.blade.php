<section class="py-1 border-bottom">
    <h2 class="font-weight-bold text-center text-captialize">LawSchools Features</h2>
    <p class="text-muted text-center" >
    Everything you need to manage your Lawschools.
    <br>
    Law Schools manage!
    </p>
    
  {{--   <p class="text-muted text-center"></p> --}}
    <div class="container">
        <div class="row" align="center">
            <div class="col-md-4 mb-4 feature-div">
                <div class="feature-circle-images">
                    <img src="{{asset('images/icons/course.png')}}" class="img-feature">
                </div>
                <h4 class="font-weight-bold">Course and Batch Management</h4>
                <p class="p-text">
                Course and Batch Management feature offered by adlaw is designed for law colleges where they manage batch of students and courses what they provide. 
                </p>
                <a href="{{route('lawschools.course_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div>
            <div class="col-md-4 mb-4 feature-div">
                <div class="feature-circle-images">
                    <img src="{{asset('images/icons/profile.png')}}" class="img-feature">
                </div>
                <h4 class="font-weight-bold">Profile Management</h4>
                <p class="p-text">
                   Adlaw offers profile management in which law colleges can create their profile. The created law colleges profile will be shown in search box.
                
                </p>
                <a href="{{route('lawschools.profile_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div>
            <div class="col-md-4 mb-4 feature-div">
                <div class="feature-circle-images">
                    <img src="{{asset('images/icons/aa8.jpg')}}" class="img-feature">
                </div>
                <h4 class="font-weight-bold">Student Management</h4>
                <p class="p-text">
                    Adlaw provide student login or profile in Student Management feature where law college can create students profile to appear the law courses. 
                </p>
                <a href="{{route('lawschools.student_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div>
            <div class="col-md-4 mb-4 feature-div">
                <div class="feature-circle-images">
                    <img src="{{asset('images/icons/aa8.jpg')}}" class="img-feature">
                </div>
                <h4 class="font-weight-bold">Document Management</h4>
                <p class="p-text">
                    It allows professionals to write the cases in word processing software and store the files with specifically labeled meta-data. 
                </p>
                <a href="{{route('lawschools.document_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div>

            <div class="col-md-4 mb-4 feature-div">
                <div class="feature-circle-images">
                    <img src="{{asset('images/icons/aa8.jpg')}}" class="img-feature">
                </div>
                <h4 class="font-weight-bold">Team Management</h4>
                <p class="p-text">
                    Adlaw's team members management feature used to create new user, edit and delete user.
                </p>
                <a href="{{route('lawschools.team_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div>
            
            <div class="col-md-4 mb-4 feature-div">
                <div class="feature-circle-images">
                    <img src="{{asset('images/icons/aa8.jpg')}}" class="img-feature">
                </div>
                <h4 class="font-weight-bold">Agenda Management</h4>
                <p class="p-text">
                    Agenda Management allows the teachers to assign priorities and ensure that action steps are taken on time, every time.
                </p>                
                <a href="{{route('lawschools.agenda_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div>
           {{--  <div class="col-md-3 mb-4 feature-div">
                <h4 class="font-weight-bold">Chat Or Messanger</h4>
                <p class="p-text">
                    {{str_limit("Course and Batch Management feature offered by adlaw is designed for law colleges where they manage batch of students and courses what they provide. This includes the list of all law courses offering by the law colleges. The course name, qualification name, course duration, and syllabus can be added by law colleges. Students can find relevant course, course duration and see the syllabus offered by law colleges.",$limit = 240, $end="...")}}
            
                </p>
                
                <a href="{{route('lawschools.profile_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div>
            <div class="col-md-3 mb-4 feature-div">
                <h4 class="font-weight-bold">Schedule Management</h4>
                <p class="p-text">
                    {{str_limit("Course and Batch Management feature offered by adlaw is designed for law colleges where they manage batch of students and courses what they provide. This includes the list of all law courses offering by the law colleges. The course name, qualification name, course duration, and syllabus can be added by law colleges. Students can find relevant course, course duration and see the syllabus offered by law colleges.",$limit = 240, $end="...")}}
                </p>
               
                <a href="{{route('lawschools.profile_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div> --}}
        </div>
    </div>
  </section>