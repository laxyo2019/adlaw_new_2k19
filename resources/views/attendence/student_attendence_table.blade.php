<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Enrollment Number</th>
			<th>Roll Number</th>
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
					<button class="btn btn-sm btn-primary"><i class="fa fa-check"></i></button>	
					<button class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button>	
				</td>
			</tr>
		@endforeach
	</tbody>
</table>