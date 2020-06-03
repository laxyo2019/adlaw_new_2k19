@extends('lawschools.main')
@section('content')
<section class="content">
@include('attendance.header')
 <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student List <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>

			</div>
			<div class="panel-body">
				<form action="{{route('attendance.report_generate')}}" method="post">
					@csrf
					<div class="row">
						@include('attendance.details')
							<div class="col-md-2">
								<input type="text" readonly="" name="attendance_date" value="{{date('Y-m')}}" class="datepicker form-control">
								@error('attendance_date')
									<span class="invalid-feedback text-danger" role="alert">
									<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
					</div>
					<div class="row mt-4" >
						<div class="col-md-12 text-center">
							<button class="btn btn-sm btn-primary search">Search</button>
						</div>
					</div>
				</form>
				<br>
				<div class="row">
					<div class="col-md-12" id="tableBody" ></div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script >
	$(document).ready(function(){
		$(function () {
			$('.datepicker').datepicker( {
			    format: "yyyy-mm",
			    viewMode: "months", 
			    minViewMode: "months"
			});
		});
	});
</script>
@endsection