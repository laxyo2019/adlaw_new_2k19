@extends('lawschools.main')
@section('content')
<section class="content">
@include('attendence.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student Attendence</h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3">
						<select class="form-control" name="batch">
							<option value="">Select Batch</option>
							@foreach($batches as $batch)
								<option value="{{$batch->id}}">{{$batch->name}}</option>
							@endforeach 
						</select>
					</div>
					<div class="col-md-3">
						<select class="form-control" name="year"> 
							<option value="">Select Admission Year</option>
							<option value="1">1 year</option>
							<option value="2">2 year</option>
							<option value="3">3 year</option>
							<option value="4">4 year</option>
							<option value="5">5 year</option>
						</select>
					</div>
					<div class="col-md-3">
						<select class="form-control" name="semester"> 
							<option value="">Select Semester</option>
							<option value="1">1st</option>
							<option value="2">2nd</option>
							<option value="3">3rd</option>
							<option value="4">4th</option>
							<option value="5">5th</option>
							<option value="6">6th</option>
							<option value="7">7th</option>
							<option value="8">8th</option>
							<option value="9">9th</option>
							<option value="10">10th</option>
						</select>
					</div>
					<div class="col-md-3">
						<button class="btn btn-sm btn-primary search">Search</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12" id="tableBody" ></div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script>
	$(document).ready(function(){
		$('.search').on('click',function(e){
			e.preventDefault();
			var batch = $('select[name="batch"] option:selected').val();
			var year = $('select[name="year"] option:selected').val();
			var semester = $('select[name="semester"] option:selected').val();
			if(batch != '' && year != '' && semester !=''){
				$.ajax({
					type:'post',
					url:'{{route('attendence.student_fetch')}}',
					data:{batch:batch,year:year,semester:semester},
					success:function(res){
						$('#tableBody').empty().html(res);
						console.log(res);
					}

				})
			}
			else{
				alert('All select field are mendarory');
			}
		})
	})
</script>
@endsection

