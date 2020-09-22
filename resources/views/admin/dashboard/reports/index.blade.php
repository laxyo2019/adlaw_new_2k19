@extends('partials.main')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Registered Lawyers List</h3>
				</div>
				<div class="box-body table-responsive">
					@include('admin.dashboard.reports.table')
				</div>
			</div>
		</div>
	</div>
</section>

@endsection