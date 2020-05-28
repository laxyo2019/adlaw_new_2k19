@extends('lawschools.main')
@section('content')
<section class="content">
@include('attendence.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Staff Attendence <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>

			</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th><input type="checkbox" name="all" class="selectAll"></th>
							<th>Name</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>
								<input type="checkbox" name="s_id[]"  class="check" value="{{$user->id}}">
							</td>
							<td>{{$user->name}}</td>
							<td></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){
		$(document).on('click','.selectAll' ,function(){	
			 console.log('select');
			 if ($(this).is( ":checked" )) {
				$('body .check').prop('checked',true);

			 }else{
				$('body .check').prop('checked',false);
			 }
		});
	});
</script>
@endsection