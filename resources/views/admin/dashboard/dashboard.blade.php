{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-4 shadow-lg ">
				<div class="small-box bg-blue ">
					<div class="inner">
						<h3>{{collect($users)->count()}}</h3>
						<h4>Total Users</h4>
						<span>Subscription: {{collect($users)->where('user_package_id','!==', null)->where('package_end','>',date('Y-m-d'))->count()}} | Unsubscription : {{collect($users)->where('user_package_id', null)->count()}}  | Deleted : {{$deletedUsers}} | Renewal : {{collect($users)->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count()}} </span>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					{{-- <br> --}}
					{{-- <a  href="#"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
				</div>
			</div>
			<div class="col-md-4 shadow-lg ">
				<div class="small-box bg-aqua ">
					<div class="inner">
						<h3>{{collect($users)->where('user_catg_id','2')->count()}}</h3>
						<h4>Total Lawyers</h4>
						<span>Registered : {{collect($users)->where('user_catg_id','2')->where('on_database','0')->count()}} | Import: {{collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','D')->count()}} | Import Registered : {{collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','!==','D')->count()}} | Subcription : {{collect($users)->where('user_catg_id','2')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count()}} | Unsubcription : {{collect($users)->where('user_catg_id','2')->where('user_package_id',null)->count()}} | Renewal : {{collect($users)->where('user_catg_id','2')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count()}} </span>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					{{-- <a  href="#"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
				</div>
			</div>
			<div class="col-md-4 shadow-lg ">
				<div class="small-box bg-orange ">
					<div class="inner">
						<h3>{{collect($users)->where('user_catg_id','3')->count()}}</h3>
						<h4>Total LawFirms</h4>
						<span>Registered : {{collect($users)->where('user_catg_id','3')->where('on_database','0')->count()}} | Import: {{collect($users)->where('user_catg_id','3')->where('on_database','1')->where('status','D')->count()}} | Import Registered : {{collect($users)->where('user_catg_id','3')->where('on_database','1')->where('status','!==','D')->count()}} | Subcription : {{collect($users)->where('user_catg_id','3')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count()}} | Unsubcription : {{collect($users)->where('user_catg_id','3')->where('user_package_id',null)->count()}} | Renewal : {{collect($users)->where('user_catg_id','3')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count()}} </span>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					{{-- <a  href="#"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
				</div>
			</div>
			<div class="col-md-4 shadow-lg ">
				<div class="small-box bg-green ">
					<div class="inner">
						<h3>{{collect($users)->where('user_catg_id','4')->count()}}</h4>
						<h4>Total Law Schools</h4>
						<span>Registered : {{collect($users)->where('user_catg_id','4')->where('on_database','0')->count()}} | Import: {{collect($users)->where('user_catg_id','4')->where('on_database','1')->where('status','D')->count()}} | Import Registered : {{collect($users)->where('user_catg_id','4')->where('on_database','1')->where('status','!==','D')->count()}} | Subcription : {{collect($users)->where('user_catg_id','4')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count()}} | Unsubcription : {{collect($users)->where('user_catg_id','4')->where('user_package_id',null)->count()}} | Renewal : {{collect($users)->where('user_catg_id','4')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count()}} </span>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					{{-- <a  href="#"  class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
				</div>
			</div>

		</div>
		<div class="row">
			{{-- <div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Messages</span>
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		 --}}
			
			{{-- <div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Users</span>
						<span class="info-box-number">{{count($users)}}</span>
					</div>
				</div>
			</div>		
	
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Lawyers</span>						
						<span class="info-box-number">{{collect($users)->where('user_catg_id','2')->count()}}</span>
					</div>
				</div>
			</div>		
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total LawFirms</span>						
						<span class="info-box-number">{{collect($users)->where('user_catg_id','2')->count()}}</span>
					</div>
				</div>
			</div>		
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total LawSchools</span>						
						<span class="info-box-number">{{collect($users)->where('user_catg_id','2')->count()}}</span>
					</div>
				</div>
			</div>		 --}}
		{{-- 
			<dcd ocdeiv class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Messages</span>
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div> --}}
		</div>	
		<div class="row">
	     {{--  <div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-money"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Billing Amount</span>						
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		

			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Current Month Billing Amount</span>						
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-orange"><i class="fa fa-money"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Current Month Account Expire</span>						
						<span class="info-box-number">1,410</span>
					</div>
				</div>
			</div>		
 --}}
	    </div>	
	</section>
@endsection