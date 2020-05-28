<div class="row">
	<div class="col-md-12 m-auto " >
		<div class="card card-primary">
			<div class="card-header with-border">
				<div class="text-center ">
					<a href="{{route('attendence.index')}}">
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'dashboard' ? 'active-li' : ''}}" >
							<i class="fa fa-cubes"></i>
							<h5>Dashboard</h5>
						</div>
					</a>
					<a href="{{route('attendence.student')}}">
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'student' ? 'active-li' : ''}}" >
							<i class="fa fa-cubes"></i>
							<h5>Student Attendence</h5>
						</div>
					</a>
					<a href="{{route('attendence.staff')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'staff' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Staff Attendence</h5>
						</div>
					</a>
					<a href="{{route('attendence.upload')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'upload' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Upload Attendence</h5>
						</div>
					</a>
					<a href="{{route('attendence.manage')}}" >
						<div class="col-md-2 col-sm-6 col-xs-11  col-div-mar col-div-nav {{Request()->segment(2) == 'manage' ? 'active-li' : ''}}" >
						<i class="fa fa-graduation-cap"></i>
						<h5>Manage Attendence</h5>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>