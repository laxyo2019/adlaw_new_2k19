@extends('lawschools.main')
@section('content')
<section class="content">
@include('attendence.header')
<div class="row">
	<div class="col-md-12 m-auto">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Student List <p class="pull-right">Today Date :- {{date('d-m-Y')}} | Time: {{date('h:i A')}}</p></h4>

			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<select class="form-control required" name="qual_catg_code" id="qual_catg">
							<option value="">Select Qualification</option>
							@foreach($qual_catgs as $qual_catg)
								<option value="{{$qual_catg->qual_catg_code}}">{{$qual_catg->qual_catg_desc}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2">
						<select class="form-control required" name="qual_code" id="qual_course">

						</select>
					</div>				
					<div class="col-md-2">
						<select class="form-control" name="batch">
							<option value="">Select Batch</option>
							@foreach($batches as $batch)
								<option value="{{$batch->id}}">{{$batch->name}}</option>
							@endforeach 
						</select>
					</div>
					<div class="col-md-2">
						<select class="form-control" name="year"> 
							<option value="">Select Admission Year</option>
							<option value="1">1 year</option>
							<option value="2">2 year</option>
							<option value="3">3 year</option>
							<option value="4">4 year</option>
							<option value="5">5 year</option>
						</select>
					</div>
					<div class="col-md-2">
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
					<div class="col-md-2">
						<button class="btn btn-sm btn-primary search">Search</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12" id="tableBody" ></div>
				</div>
				{{-- <div class="row">
					<div class="col-md-3 mt-2">
						<select class="form-control required" name="qual_catg_code" id="qual_catg">
							<option value="">Select Qualification</option>
							@foreach($qual_catgs as $qual_catg)
								<option value="{{$qual_catg->qual_catg_code}}">{{$qual_catg->qual_catg_desc}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3 mt-2">
						<select class="form-control required" name="qual_code" id="qual_course">

						</select>
					</div>				
					<div class="col-md-3 mt-2">
						<select class="form-control" name="batch">
							<option value="">Select Batch</option>
							@foreach($batches as $batch)
								<option value="{{$batch->id}}">{{$batch->name}}</option>
							@endforeach 
						</select>
					</div>
					<div class="col-md-3 mt-2">
						<select class="form-control" name="year"> 
							<option value="">Select Admission Year</option>
							<option value="1">1 year</option>
							<option value="2">2 year</option>
							<option value="3">3 year</option>
							<option value="4">4 year</option>
							<option value="5">5 year</option>
						</select>
					</div>
					<div class="col-md-3 mt-2">
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
					<div class="col-md-3 mt-2">
						<input type="text" name="start_date" readonly="readonly" class="datepicker form-control start_date" value="{{date('Y-m-d')}}">
					</div>
					<div class="col-md-3 mt-2">
						<input type="text" name="end_date" readonly="readonly" class="datepicker form-control end_date" value="{{date('Y-m-d')}}">
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-md-12 text-center">
						<button class="btn btn-md btn-primary search">Search</button>
					</div>
				</div> --}}
				<br>
				<div class="row">
					<div class="col-md-12" id="tableBody" ></div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<script >
	$(document).ready(function(){
		$(function () {
			$(".datepicker").datepicker({
				format: 'yyyy-mm-dd'
			});
		});

		$('#qual_catg').on('change',function(e){
			e.preventDefault();
			var qual_catg_code = $(this).val();
			qual_course(qual_catg_code);
			qual_docs(qual_catg_code);
		});
		$('.search').on('click',function(e){
			e.preventDefault();
			filter_students();
		});

		// function filter_students(){
		// 	var qual_catg_code = $('select[name="qual_catg_code"] option:selected').val();
		// 	var qual_code = $('select[name="qual_code"] option:selected').val();
		// 	var batch = $('select[name="batch"] option:selected').val();
		// 	var year = $('select[name="year"] option:selected').val();
		// 	var semester = $('select[name="semester"] option:selected').val();
		// 	var start_date = $('input[name="start_date"]').val();
		// 	var end_date = $('input[name="end_date"]').val();
			
		// 	if(qual_catg_code!='' && qual_code != '' && batch != '' && year != '' && semester !='' && start_date !='' && end_date !=''){

		// 		if(end_date >= start_date){
		// 			$.ajax({
		// 				type:'post',
		// 				url:'{{route('attendence.student_filter')}}',
		// 				data:{qual_code:qual_code,qual_catg_code:qual_catg_code,batch:batch,year:year,semester:semester,start_date:start_date,end_date:end_date},
		// 				success:function(res){
		// 					 $('#tableBody').empty().html(res);
		// 					// console.log(res);
		// 				}

		// 			});
		// 		}else{
		// 			alert('End date must after start date');	
		// 		}				
		// 	}
		// 	else{
		// 		alert('All select field are mendarory');
		// 	}
		// }






		// $(".start_date,.end_date").datepicker({
  //   		format : 'yyyy-mm-dd',
  //   	});

		function filter_students(){
			var qual_catg_code = $('select[name="qual_catg_code"] option:selected').val();
			var qual_code = $('select[name="qual_code"] option:selected').val();
			var batch = $('select[name="batch"] option:selected').val();
			var year = $('select[name="year"] option:selected').val();
			var semester = $('select[name="semester"] option:selected').val();
			if(qual_catg_code!='' && qual_code != '' && batch != '' && year != '' && semester !=''){
				$.ajax({
					type:'post',
					url:'{{route('attendence.student_filter')}}',
					data:{qual_code:qual_code,qual_catg_code:qual_catg_code,batch:batch,year:year,semester:semester},
					success:function(res){
						$('#tableBody').empty().html(res);
						// console.log(res);
					}

				})
			}
			else{
				alert('All select field are mendarory');
			}
		}
	});
</script>
@endsection