@extends('layouts.default')
@section('title','Contact Us - Lawyers, Law Firm, Law School Portal | Legal Services |Adlaw')
@section('description','Contact us for all legal services or find the best Lawyers, law firms and law schools.')
@section('keywords', 'legal services, find a lawyer, lawyers portal India, find legal advisor, Best Lawyers in India, top lawyers, law firm portal, top lawyers in India, lawyers ranking in India')
@section('content')
@include('layouts.hero_section')
<div class="container container-div">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 h2-text">
            <h2 class="font-weight-bold text-center text-white">CONTACT US</h2>          
            <p class="text-center w-responsive mx-auto mb-5 " style="opacity: 1;
    transform: translateZ(0);">Do you have any questions? Please do not hesitate to contact us directly. <br> Our team will come back to you within
      a matter of hours to help you.</p>
        </div>
    <!--Section description-->
    <div class="container">
        <div class="row">
      @if (session('message'))
        <div class="alert alert-success col-md-9">
        {{ session('message') }}
        </div>
        @endif
            <!--Grid column-->
            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 mb-4">
              <div class="card shadow">

                <div class="card-header bg-white  text-center">
                  <h3 class="font-weight-bold">Get in Touch</h3>
                </div>
                <div class="card-body ">
                  <form id="contact-form"  action="{{route('contact.store')}}" method="POST">
                   {{ csrf_field() }}
                     <div class="row form-group">
                        <div class="col-md-6">
                              <label for="fname" class="font-weight-bold">Your First Name <span class="text-danger">*</span> </label>
                              <input type="text" name="fname" class="form-control" placeholder="Enter first name" value="{{old('fname')}}"> 
                              @error('fname')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                              @enderror                  
                        </div>
                        <div class="col-md-6">
                             <label for="name" class="font-weight-bold">Your Last Name <span class="text-danger">*</span> </label>
                              <input type="text" name="lname" class="form-control" placeholder="Enter last name" value="{{old('lname')}}"> 
                              @error('lname')
                                <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-6">
                            <label for="cemail" class=" font-weight-bold">Your Email Address<span class="text-danger">*</span></label>
                            <input type="email" id="email" name="cemail" class="form-control" placeholder="Enter email address" value="{{old('cemail')}}">
                            @error('cemail')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror  
                        </div>
                        <div class="col-md-6">
                              <label for="mobile" class="font-weight-bold">Your Mobile Number <span class="text-danger">*</span></label>
                              <input type="text" id="mobile" name="mobile_no" class="form-control" placeholder="Enter mobile number" value="{{old('mobile_no')}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile')}}">
                              @error('mobile_no')
                                <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              @enderror 
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                            <label for="address" class="font-weight-bold">Your Address </label>
                            <textarea class="form-control" name="address" placeholder="Enter your address" rows="2">{{ old('address')}}</textarea> 
                            @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror 
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                          <label for="message" class="font-weight-bold">Your message</label>
                          <textarea type="text" id="message" name="message" rows="3" class="form-control md-textarea" placeholder="Enter message here...">{{old('message')}}</textarea>
                        </div>
                     </div>
                     <div class="row form-group">
                        <div class="col-md-12">
                            <button class="btn btn-md bg-success btn-round" type="submit"> Submit</button>
                        </div>
                     </div>
                    </form>
                  </div>
                
              </div>
            </div>                       
  <div class="col-md-3 text-center">
      <ul class="list-unstyled mb-0">
          <li><i class="fa fa-map-marker fa-2x" aria-hidden="true"></i>
              <p>Adlaw </p>
          </li>

          <li><i class="fa fa-phone mt-4 fa-2x"></i>
              <p>0731 404 3798</p>
          </li>

          <li><i class="fa fa-envelope mt-4 fa-2x"></i>
              <p>info@adlaw.in</p>
          </li>
      </ul>
  </div>
<!--Grid column-->

</div>
</div>


</div>
</div>
@endsection
