{{-- @extends('lawfirm.main') --}}
@extends('partials.main')
@section('content')
<section class="content">
<div class="row">
	<div class="col-md-12 col-xs-12 col-sm-12 m-auto">
		<div class="box box-primary">
			<div class="box-header " >
				<div class="row">
					<div class="col-md-12">
						<h3 style="margin-top: 10px;">Book an Appointment</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-sm btn-info" style="margin-top: 20px;" id="unbooked">Unconfirmed Appointment</button>
						<button class="btn btn-sm btn-secondary" style="margin-top: 20px;" id="booked">Confirmed Appointment</button>
						<button class="btn btn-sm btn-secondary" style="margin-top: 20px;" id="cancelled">Cancelled Appointment</button>
						<button class="btn btn-sm btn-secondary" style="margin-top: 20px;" id="applyBtn">Apply Appointments</button>
					</div>
				</div>
				
			</div>
			<div class="box-body table-responsive " >
				<div class="row">
					<div class="col-md-12 unbookedTable"> 
						@if($message = Session::get('success'))
							<div style="margin-top: 10px;" class="alert bg-success">
							{{$message}}
							</div>
						@endif
					<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Client Name</th>
								<th>Client Address</th>
								<th>Client Mobile Number</th>
								<th>Appointment Time</th>
								<th>Appointment Date</th>
								<th>Action</th>								
							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							
								@foreach($unbookings as $booking)
								<tr>
									<td>{{++$count}}</td>			
									<td>{{$booking->users->name}}</td>	
									<td>{{$booking->users->city_name .', '. $booking->users->state_name}}</td>
									<td>{{$booking->users->mobile}}</td>		
									<td>@foreach($slots as $slot)
									{{$booking->plan_id == $slot->id ? date('h:i A', strtotime($slot->slot)) : ''}}
									@endforeach	
									</td>	
									<td>{{date('d-m-Y', strtotime($booking->b_date))}}</td>			
									<td>
										<a href="{{route('bookingUpdate',['id'=>$booking->id])}}" class="btn btn-sm btn-success" id="Accept">Accept</a>
					
										<button class="btn btn-sm btn-danger" id="cancelBtn" data-id ="{{$booking->id}}"> Cancelled</button>
									
									</td>		
								</tr>
								@endforeach
							
						</tbody>
						</table>
					</div>
					<div class="col-md-12 bookedTable" style="display: none;"> 
						<table class="table table-hover table-striped table-bordered" >
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Client Name</th>
								<th>Client Address</th>
								<th>Client Mobile Number</th>
								<th>Appointment Time</th>
								<th>Appointment Date</th>
								

							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp

							@foreach($booked as $book)
							<tr>
								<td>{{++$count}}</td>			
								<td>{{$book->users->name}}</td>	
								<td>{{$book->users->city_name .', '. $book->users->state_name}}</td>
								<td>{{$book->users->mobile}}</td>		
								<td>@foreach($slots as $slot)
								{{$book->plan_id == $slot->id ? date('h:i A', strtotime($slot->slot)) : ''}}
								@endforeach	
								</td>	
								<td>{{date('d-m-Y', strtotime($book->b_date))}}</td>			
							</tr>
							@endforeach
						</tbody>
						</table>
					</div>
					<div class="col-md-12 cancelledTable" style="display: none;"> 
						<table class="table table-hover table-striped table-bordered" >
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Client Name</th>
								<th>Client Address</th>
								<th>Client Mobile Number</th>
								<th>Appointment Time</th>
								<th>Appointment Date</th>
								

							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							@foreach($cancelled as $book)
							<tr>
								<td>{{++$count}}</td>			
								<td>{{$book->users->name}}</td>	
								<td>{{$book->users->city_name .', '. $book->users->state_name}}</td>
								<td>{{$book->users->mobile}}</td>		
								<td>@foreach($slots as $slot)
								{{$book->plan_id == $slot->id ? date('h:i A', strtotime($slot->slot)) : ''}}
								@endforeach	
								</td>	
								<td>{{date('d-m-Y', strtotime($book->b_date))}}</td>			
							</tr>
							@endforeach
						</tbody>
						</table>
					</div>
					<div class="col-md-12 applyBookingsTable" style="display: none;"> 
						<table class="table table-hover table-striped table-bordered" >
							<thead>
								<tr>
									<th>SNo.</th>
									<th>Lawyer Name</th>
									<th>Booking Time</th>
									<th>Booking Date</th>
									<th>Reason</th>
									<th>Booking Status</th>	
								</tr>
							</thead>
							<tbody>
								@php $count= 0; @endphp
								@foreach($apply_bookings as $booking)
								<tr>
									<td>{{++$count}}</td>
									<td>{{$booking->name}}</td>
									<td>{{date('h:i A',strtotime($booking->slot))}}</td>
									<td>{{date('d-m-Y',strtotime($booking->b_date))}}</td>
									<td>{{$booking->reason}}</td>
									<td>
									@if($booking->client_status==1 && $booking->user_status==0)
										<p class="text-primary">{{'Pending'}}</p>
									@elseif($booking->client_status==1 && $booking->user_status==1)
										<p class="text-success">{{'Booked'}}</p>
									@else
										<p class="text-danger">{{'Cancelled'}} </p>
									@endif

									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
									
				</div>			
			</div>
			@include('models.booking_cancel')
		</div>
	</div>
</div>
</section>

<script>
	$(document).ready(function(){
		$('.table').DataTable();

		$('#unbooked').on('click',function(){
			$('.bookedTable').hide();
			$('.cancelledTable').hide();
			$('.unbookedTable').show();
			$('.applyBookingsTable').hide();

			$('#unbooked').removeClass('btn-secondary');
			$('#unbooked').addClass('btn-info');
			$('#booked').removeClass('btn-info');
			$('#cancelled').removeClass('btn-info');
			$('#applyBtn').removeClass('btn-info');
		});
		$('#booked').on('click',function(){
			$('.bookedTable').show();
			$('.cancelledTable').hide();
			$('.unbookedTable').hide();
			$('.applyBookingsTable').hide();

			$('#unbooked').removeClass('btn-info');
			$('#booked').addClass('btn-info');
			$('#cancelled').removeClass('btn-info');
			$('#unbooked').addClass('btn-secondary');
			$('#applyBtn').removeClass('btn-info');


		});
		$('#cancelled').on('click',function(){
			$('.bookedTable').hide();
			$('.cancelledTable').show();
			$('.unbookedTable').hide();
			$('.applyBookingsTable').hide();

			$('#unbooked').removeClass('btn-info');
			$('#booked').removeClass('btn-info');
			$('#cancelled').addClass('btn-info');
			$('#unbooked').addClass('btn-secondary');
			$('#applyBtn').removeClass('btn-info');
		});
		$('#applyBtn').on('click',function(){
			$('.bookedTable').hide();
			$('.cancelledTable').hide();
			$('.unbookedTable').hide();
			$('.applyBookingsTable').show();

			$('#unbooked').removeClass('btn-info');
			$('#booked').removeClass('btn-info');
			$('#cancelled').addClass('btn-secondary');
			$('#unbooked').addClass('btn-secondary');
			$('#applyBtn').addClass('btn-info');
			$('#cancelled').removeClass('btn-info');
		});

		$('#cancelBtn').on('click',function(e){
			e.preventDefault();
			$('#booking_id').val($(this).data('id'));
			$('#cancelledAppointmentModal').modal('show');
		})
	});
</script>
@endsection