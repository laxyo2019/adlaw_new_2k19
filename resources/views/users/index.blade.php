@extends('admin.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="">Users <a href="{{route('users.create')}}" class="btn btn-sm btn-primary pull-right">Add User</a></h3>

						<div class="row">
							<div class="col-md-4 mt-4 form-group">
								<label>User Category</label>
								<select class="form-control">
									<option value="0">--- All ---</option>
									@foreach($roles as $role)
										<option value="{{$role->id}}">{{$role->display_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4 mt-4 form-group">
								<label>Types</label>
								<select class="form-control">
									<option value="0">--- All ---</option>
									<option value="1">Subscription Users</option>
									<option value="2">UnSubscription Users</option>
									
								</select>
							</div>
							<div class="col-md-1 mt-4 form-group">
								<label></label>
								<button class="btn btn-sm btn-info form-control mt-2">Filter</button>
							</div>
						</div>
					</div>
					<div class="box-body table-responsive">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						<table class="table table-striped table-bordered" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>User Name</th>
									<th>Email Address</th>
									<th>Mobile Number</th>
									<th>User Type</th>
									<th>Registration Date</th>
									<th>Status</th>
									<th style="width: 20%">Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($users as $user)
									<tr>
										<td>{{++$count}}</td>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->mobile}} {{$user->mobile_no1 == '' ? '' : '|'}} {{$user->mobile_no1}}</td>
										<td>{{$user->role != null ? $user->role['display_name']  : '-'}}</td>
										<td>{{date('d-m-y', strtotime($user->created_at))}}</td>
										<td>{{$user->status == 'A' ? 'Active' : ($user->status == 'P' ? 'Pending For Email Verified' : 'Suspended') }}</td>
										 <td>

										 	<form action="{{route('users.destroy', ['id' =>  $user->id ])}}" method="POST" id="delform_{{ $user->id }}">
											@method('DELETE')

										 	<a href="{{route('users.edit',$user->id)}}"><i class="fa fa-edit text-green btn btn-sm"></i></a>

										 	<a href="#"><i class="fa fa-gear btn btn-sm"></i></a>

										 	<a href="javascript:void(0)" onclick="loginhistory('{{ $user->id }}')" title="user login history" data-id="modal" id="loginbtn"><i class="fa fa-clock-o btn btn-sm" style="font-size: 16px"></i></a>

										 	<a href="javascript:$('#delform_{{ $user->id }}').submit();"  onclick="return confirm('Are you sure?')" ><i class="fa fa-trash text-danger btn btn-sm" ></i></a>

										 	@csrf
											</form>

										 </td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
@include('models.login_history')	
		</div>
	</section>
	<script type="text/javascript">

	function loginhistory($id){
		var id = $id;
		$.ajax({
			type:'POST',
			url: "{{ route('login_history')}}",
			data: {id:id},
			success:function(res){

				$('#login_time').empty();
				$('#login_time').append("<td>"+(res.last_login_in_at !=null ? res.last_login_in_at : '')+"</td>");
				$('#login_time').append("<td>"+(res.last_logout_in_at != null ? res.last_logout_in_at : '-' )+"</td>");
				$('#login').modal('show');
				// console.log(res.last_login_in_at);
			}
		});
	}

	$(document).ready(function(){		
		$('#myTable').DataTable();
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

    });
</script>
@endsection