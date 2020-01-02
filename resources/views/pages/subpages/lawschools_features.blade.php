@extends("layouts.default")
@section('content')
<div class="container-fluid pt-4">
	
	<div class="row">
		<div class="col-md-3 border-r " style="background-color: #d9d9d9;">
			<div class="slider form-group pt-4" >
				<div class="slider-header">
					<h3 class="font-weight-bold">Search</h3>
				</div>
				<div class="slider-body">
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Enter College Name</label>
							<input type="text" name="user_name" class="form-control" placeholder="Search name here">
						</div>
						<div class="col-md-12 form-group">
							<label>Select State</label>
							<select class="form-control select2" name="state_code" id="state">
								<option value="0">Select State</option>	
								@foreach($states as $state)
									<option value="{{$state->state_code}}">{{$state->state_name}}</option>
								@endforeach 
							</select>	
						</div>						
					</div>
					<div class="row">
						<div class="col-md-12 form-group ">
							<label>Select City</label>
							<select class="form-control select2" name="city_code" id="city">
								
							</select>		
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group ">
							<button class="btn btn-md btn-round filteBtn">Search</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">	
			<div class="row ">
				<div class="col-sm-12 col-md-12 col-xl-12 text-center mb-2 border-bottom">
		            <h2 class="h1-responsive font-weight-bold text-center text-uppercase">Law Schools</h2>  
		            <p><i>Easily Find Top Rated Law College.</i></p>        
		        </div>
			</div>		
			<div class="row "  id="withoutsearchDiv">
				<div class="col-md-12 col-sm-12 col-xm-12" id="tablediv">
					@include('pages.subpages.search.lawschools_table')
				</div>
			</div>
		</div>
	    
	</div>	
</div>
<script >
	$(document).ready(function(){
		$('.select2').select2();
		$('#state').on('change',function(){
			var state_code = $(this).val();	
			var city_code = "";
			state(state_code,city_code);
		});

		$(".filteBtn").on('click',function(e){
			e.preventDefault();
			var user_name = $("input[name='user_name']").val();
			var state_code = $('#state').val();
			var city_code = $('#city').val();
			console.log(user_name);
			$.ajax({
			    type:"get",
			    url:"{{ route('lawschools.search') }}?state_code="+state_code+'&city_code='+city_code+'&user_name='+user_name,
		        }).done(function(data){
		            $("#tablediv").empty().html(data);
		            // console.log(data);
		        }).fail(function(jqXHR, ajaxOptions, thrownError){
		            alert('No response from server');
				});
		});

		$(document).on('click', '.pagination a',function(event)
			{
			    event.preventDefault();

			    $('li').removeClass('active');
			    $(this).parent('li').addClass('active');
			    var myurl = $(this).attr('href');
                var page=$(this).attr('href').split('page=')[1];

				var user_name = $("input[name='user_name']").val();
				var state_code = $('#state').val();
				var city_code = $('#city').val();
			    getData(page,user_name,state_code,city_code);
			});


			function getData(page,user_name,state_code,city_code){

			    $.ajax({
			        url:"{{ route('lawschools.search') }}?state_code="+state_code+'&city_code='+city_code+'&user_name='+user_name+'&page='+page,
			        type: "get",
			        datatype: "html"
			    }).done(function(data){
			    
			        $("#tablediv").empty().html(data);
			        location.hash = page;
			    }).fail(function(jqXHR, ajaxOptions, thrownError){
			          alert('No response from server');
			    });
			}



	});
</script>
@endsection