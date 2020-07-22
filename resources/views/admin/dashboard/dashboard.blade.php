{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<style>
.loader {
  border: 6px solid #f3f3f3;
  border-radius: 50%;
  border-top: 6px solid #3498db;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

	<section class="content">
		<div class="row">
			<div class="col-md-4 shadow-lg ">
				<div class="small-box bg-blue ">
					<div class="inner">
						<h3 class="user_total"><div class="loader"></div></h3>
						<h4>Total Users</h4>
						<span>Subscription: <span class="user_subscription">0</span> | Unsubscription : <span class="user_unsubscription">0</span>   | Deleted : <span class="user_delete">0</span> | Renewal : <span class="user_renewal">0</span> </span>
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
						<h3 class="lawyer_total"><div class="loader"></div></h3>
						<h4>Total Lawyers</h4>
						<span>Registered : <span class="lawyer_registered">0</span> | Import: <span class="lawyer_import">0</span> | Import Registered : <span class="lawyer_import_reg">0</span> | Subcription :  <span class="lawyer_subscirption">0</span>  | Unsubcription : <span class="lawyer_unsubscirption">0</span> | Renewal : <span class="lawyer_renewal">0</span> </span>
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
<script >
	$(document).ready(function(){
		$.ajax({
			type:'get',
			url : "{{route('admin.user_data_fetch')}}",
			success:function(res){
				$('.user_total').empty().html(res.user_total);
				$('.user_subscription').empty().html(res.user_subscription);
				$('.user_unsubscription').empty().html(res.user_unsubscription);
				$('.user_delete').empty().html(res.user_delete);
				$('.user_renewal').empty().html(res.user_renewal);
				
				$('.lawyer_total').empty().html(res.lawyer_total);
				$('.lawyer_registered').empty().html(res.lawyer_registered);
				$('.lawyer_import').empty().html(res.lawyer_import);
				$('.lawyer_import_reg').empty().html(res.lawyer_import_reg);
				$('.lawyer_subscirption').empty().html(res.lawyer_subscirption);
				$('.lawyer_unsubscirption').empty().html(res.lawyer_unsubscirption);
				$('.lawyer_renewal').empty().html(res.lawyer_renewal);
			}
		})
	})
</script>
@endsection