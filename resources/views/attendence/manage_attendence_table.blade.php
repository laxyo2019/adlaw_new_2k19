<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>
				#
			</th>
			<th>Student Name</th>
			<th>Enrollment Number</th>
			<th>Roll Number</th>
			<th>Start Date</th>
			<th>End Date</th>
			{{-- <th>Attendent Date</th> --}}
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@php $count = 1; @endphp
		@foreach($students as $student)
			<tr>
				<td>{{$count++}}</td>
				<td>{{$student->f_name .' '. $student->l_name }}</td>
				<td>{{$student->enroll_no}}</td>
				<td>{{$student->roll_no}}</td>
				
				<td>
					<button class="btn btn-sm btn-primary">Show Attendence</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-sm btn-success pull-right" id="btnSubmit">Submit</button>
	</div>
</div>
