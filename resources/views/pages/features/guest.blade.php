<section class="py-1 border-bottom bg-light" >
    <h2 class="font-weight-bold text-center text-captialize">Guest / Users Features</h2>
     <span class="span-line mt-4 mb-4"></span>
     <br>
   {{--  <p class="text-muted text-center" >
    Everything you need to manage your account.

    </p> --}}
  {{--   <p class="text-muted text-center"></p> --}}
    <div class="container">
        <div class="row" align="center">
            {{-- <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Profile</h4>
                <p class="p-text">
                {{str_limit('Adlaw offers profile management in which user can create their profile, update and deactivate the profile whether user is a guest, lawyer or law intern. In the profile users can put all the detail about their area of specialization and relevant cases.',$limit = 250, $end = '...')}}              
                </p>                
                <a href="{{route('guest.profile_management')}}" class="btn btn-sm btn-info">More Info</a>
            </div> --}}
            <div class="col-md-4 mb-4">
                <a href="{{route('guest.search_lawyer')}}" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/search.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Search Lawyer / Law Firms </h4>
                            <p class="p-text">
                              Search and find lawyer, law school or law firm near you, No matter where you are located.
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/calendar.jpg')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Calendar</h4>
                            <p class="p-text">
                            Adlaw helps you monitor what's going in your cases on one convenient, central calendar so nothing slips through the cracks.
                            </p>
                      
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
            {{-- <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Reviews to Lawyer / Law Firms and LawSchools</h4>
                <p class="p-text">
                {{str_limit("Adlaw helps you monitor what's going in your cases on one convenient, central calendar so nothing slips through the cracks. User can see occasions to specific cases created by lawyer or law firm. So whether it’s an upcoming court date or statement, to-dos, hearing sessions morning or evening etc. The Adlaw Calendar ensures you’re always prepared.",$limit = 224, $end = '...')}}  
                
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div> --}}

            <div class="col-md-4 mb-4">
                <a href="" class="feature-link" >
                    <div class="card feature-div">
                        <div class="card-header bg-white border-0 ">
                            <div class="feature-circle-images">
                                <img src="{{asset('images/icons/appointment.png')}}" class="img-feature">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-bold">Book An Appointment</h4>
                            <p class="p-text">
                            After finding a relevant law firm, lawyer or law school user can book appointment accordingly and see the status of appointment whether it is confirmed pending or canceled. 
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button class="btn btn-sm btn-info">More Info</button>
                        </div>
                    </div>
                </a>
            </div>
           {{--  <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Case Related Information</h4>
                <p class="p-text">
                    {{str_limit("Once you have a list of cases, you can sort and view by ‘running’, ‘closed’ or ‘transferred/NOC’ filters. You can filter cases by a number of criteria, such as title, case number, client, team member and more. There is no other quicker way to find and refer to cases, especially if you’re working on a number of cases and have a full case diary.",$limit = 240, $end="...")}}
                
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div>
            <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Case Hearing Notification</h4>
                <p class="p-text">
                    {{str_limit("You will be notify about all the case related hearing dates. Adlaw offers you a view of all the details you have entered, cases related and documents uploaded for each matter in a clean, clutter-free way. Case Hearing Notification enables you to manage your time as well as track time spent by team members on case-related activities.",$limit = 230, $end="...")}}
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div> --}}
          {{--   <div class="col-md-3 mb-4">
                <h4 class="font-weight-bold">Chat Or Messanger</h4>
                <p class="p-text">
                {{str_limit("Our case management system has made managing information easier than ever before. Create a case in just a few seconds. The case will create its activity stream as you keep adding information, making updates and attaching documents. Everything comes together seamlessly to provide the big picture systematically.",$limit = 220, $end="...")}}
                </p>
                <a href="" class="btn btn-sm btn-info">More Info</a>
            </div> --}}

        </div>
    </div>
    <br>
    <br>
  </section>