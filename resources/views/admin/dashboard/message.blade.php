{{-- @extends('admin.main') --}}

@extends('partials.main')
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-md-12">

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Upload
						</h3>
					</div>
					<div class="box-body">
						@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
						@endif
						<form action="{{route('message_sent_store')}}" method="post" enctype="multipart/form-data">
							@csrf
						<div class="row">
							<div class="col-md-12 form-group">
							<textarea value="" class="form-control" name="message"></textarea>
							<br>
								<button type="submit" class="btn btn-success btn-sm">Submit</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection