@extends('lawschools.main')
@section('content')
<section class="content">
@include('attendence.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Upload Attendence <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>
			</div>
		</div>
	</div>
</div>
</section>
@endsection