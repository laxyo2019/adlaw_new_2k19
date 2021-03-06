{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Court Type <a href="{{route('court_category.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('court_category.update',['id'=>$court_type->court_type])}}" method="post">
						@csrf 
						@method('PATCH')
							<div class="row form-group">
								<div class="col-md-6">
									<label>Court Group Name <span class="text-danger">*</span></label>
									<select name="court_group_code" class="form-control">
										<option value="0">Select Group Name</option>
										@foreach($courtgrups as $courtgrup)
											<option value="{{$courtgrup->court_group_code}}" {{$court_type->court_group_code == $courtgrup->court_group_code ? 'selected' : ''}} {{old('court_group_code') == $courtgrup->court_group_code ? 'selected' : '' }}>{{$courtgrup->court_group_name}}</option>
										@endforeach
									</select>
									@error('court_group_code')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label> Court Type Name <span class="text-danger">*</span></label>
									<input type="text" name="court_type_desc" class="form-control" placeholder="Enter Court Type Name" value="{{old('court_type_desc') ?? $court_type->court_type_desc}}">
									@error('court_type_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								<div class="col-md-6">
									<label> Court Type Short Name</label>
									<input type="text" name="short_desc" class="form-control" placeholder="Enter Court Type Short Name" value="{{old('short_desc') ?? $court_type->short_desc}}">
									@error('short_desc')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
								</div>
								
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<input type="submit" value="Submit" class="btn btn-sm btn-primary">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
