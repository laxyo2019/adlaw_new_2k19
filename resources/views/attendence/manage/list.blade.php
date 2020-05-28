<table class="table table-striped table-bordered">
	<thead>
		<th>#</th>
		<th>Attendence Date</th>
		<th>Status</th>
		<th>Action</th>
	</thead>
	<tbody>
		@php $count =1 @endphp
		@foreach($attendences as $attendence)
			<tr>
				<td>{{$count++}}</td>
				<td>{{$attendence->attendence_date}}</td>
				<td>{{$attendence->status}}</td>
				<td>
					<input type="checkbox" name="attendence_date[]"  class="check" value="{{$attendence->attendence_date}}" {{$attendence->status == 'P' ? 'checked="checked"' : ''}}>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>