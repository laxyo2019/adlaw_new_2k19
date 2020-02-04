@extends(Auth::user()->user_catg_id == '5' ? 'customer.main' : (Auth::user()->user_catg_id == '2' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '3' ? 'lawfirm.main' : (Auth::user()->user_catg_id == '4' ? 'lawschools.main' : (Auth::user()->user_catg_id == '6' ? 'lawschools.main' : (Auth::user()->user_catg_id == '7' ? 'lawschools.main' : 'admin.main'))))))
@section('content')
<style >


.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0;
  font-size: 1.9rem;
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: 3rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 1.5rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

.pricing .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  opacity: 0.7;
  transition: all 0.2s;
}

/* Hover Effects on Card */

@media (min-width: 992px) {
  .pricing .card:hover {
    /*margin-top: -5px;*/
    /*margin-bottom: .25rem;*/
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
  }
  .pricing .card:hover .btn {
    opacity: 1;
  }
}
</style>
<section class="content pricing">

    <div class="row">
     @foreach($packages as $package)
      <div class="col-lg-4 col-md-4 col-sm-12 col-xl-4 col-xs-12 " style="margin-top: 10px; margin-bottom: 20px;">
        <div class="card mb-5 mb-lg-0">
          <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">{{$package->name}}</h5>
            <h6 class="card-price text-center"><i class="fa fa-rupee"></i> {{$package->price}} <span class="period">{{$package->duration}} - {{$package->duration_type}}</span></h6>
            <hr>
            @php 
              echo $package->description;
            @endphp
          {{--   <ul class="fa-ul">
              <li><span class="fa-li"><i class="fa fa-check"></i></span>100 Clients</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>5GB Storage</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Public Projects</li>
              <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Unlimited Private Projects</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Dedicated Phone Support</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Free Subdomain</li>
              <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Monthly Status Reports</li>
            </ul> --}}
            <a href="{{route('package.show', $package->id)}}" class="btn btn-block btn-primary text-uppercase">Buy</a>
          </div>
        </div>
      </div>
     @endforeach
    </div>

</section>
@endsection