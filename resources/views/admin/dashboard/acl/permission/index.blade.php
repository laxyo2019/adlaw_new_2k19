{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header with-border">
					<h4 class="card-title">Permission Manage
						<a href="{{route('permission.create')}}" class="btn btn-sm btn-primary pull-right">Create</a>
					</h4>
				</div>
				<div class="card-body">
					<div class="row">
			            <div class="col-md-12">
			                @if($message = Session::get('success'))
			                  <div class="alert bg-success">
			                      {{$message}}
			                  </div>
			                @endif  
			            </div>
			        </div>
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Display Name</th>
										<th>Description</th>
										<th>Created Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($permissions as $permission)
										<tr>
											<td>{{$permission->id}}</td>
											<td>{{$permission->name}}</td>
											<td>{{$permission->display_name}}</td>
											<td>{{$permission->description}}</td>
											<td>{{$permission->created_at}}</td>
											<td>
												<a href="{{route('permission.edit',$permission->id)}}" class="btn btn-sm bg-success"><i class="fa fa-edit"></i></a>

											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection