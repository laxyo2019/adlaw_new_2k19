@extends('lawschools.main')
@section('content')
<section class="content">
@include('attendence.header')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student Attendence <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3">
						<input type="text" name="start_date" class="datepicker form-control" readonly="readonly">
					</div>
					<div class="col-md-3">
						<input type="text" name="start_date" class="datepicker form-control" readonly="readonly">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){
		$(function () {
			$(".datepicker").datepicker({
				format: 'yyyy-mm-dd'
			});
		});
	});
</script>
@endsection
