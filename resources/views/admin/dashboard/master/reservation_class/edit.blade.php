{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="">Edit Reservation Class <a href="{{route('reservation.index')}}" class="btn btn-sm btn-primary pull-right">Back</a></h3>
					</div>
					<div class="box-body">
						<form action="{{route('reservation.update',['id'=>$reservation->id])}}" method="post" >
							@method('PATCH')
							@csrf 
							<div class="row form-group">							
								<div class="col-md-6">
									<label for="">Reservation Class Name <span class="text-danger">*</span>
									</label>
									<input type="text" class="form-control" name="name" required="" placeholder="Enter Reservation Class Name" value="{{old('name') ?? $reservation->name}}"> 
									@error('name')
										<span class="text-danger">
											<strong>{{$message}}</strong>
										</span>
									@enderror
					            </div>
							</div>					
							<div class="row ">
								<div class="col-md-12 ">
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
