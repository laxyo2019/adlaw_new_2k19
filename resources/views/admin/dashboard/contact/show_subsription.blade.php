@extends('admin.main')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header with-border">
					<h4 class="card-title">Subscription Contact List</h4>
					<div class="card-options" id="btngroup">
						<button class="btn btn-sm btn-info" id="btnAll">All Subscriptions</button>
						<button class="btn btn-sm btn-default" id="btnNew">New Subscriptions</button>
						<button class="btn btn-sm btn-default" id="bntRenew">Renew Subscriptions</button>
					</div>
				</div>

				<div class="card-body table-responsive" id="tableBody"> 
					@include('admin.dashboard.contact.table_subscription')
				</div>
			</div>

			<div class="modal fade" id="activeModal" >
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="exampleModalLabel">User Package Plan Active</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="activeForm">
						@csrf
						<div class="modal-body">
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Package Name</label>
									<select class="form-control package" name="package_id">
										<option value="0">Select Package</option>
										@foreach($packages as $package)
											<option value="{{$package->id}}">{{$package->name}}</option>
										@endforeach
									</select>

								</div>
								<div class="col-md-6 form-group">
									<label>Package Amount</label> <span class="text-nuted">(In Rupees)</span>
									<input type="text" name="package_amount" class="form-control" readonly="readonly" >
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 form-group">
									<label>Dicount User</label>
									<select class="form-control discount_status" name="discount_status">
										<option value="1">Yes</option>
										<option value="0" selected="selected">No</option>
									</select>
								</div>								
							</div>
							<div class="row" style="display: none" id="discountDiv">
								<div class="col-md-6 form-group">
									<label>Dicount Percent</label>
									<input type="text" name="discount_perc" value="" class="form-control discount_perc">
									<span class="invalid-feedback text-danger percent_error" role="alert" style="display:none">
										<strong>{{ __('Only number and decimal allowed') }}</strong>
									</span>
								</div>
								<div class="col-md-6 form-group">
									<label>Dicount Amount</label> <span class="text-nuted">(In Rupees)</span>
									<input type="text" name="dicount_amount" readonly="readonly" class="form-control">
								</div>	
								<div class="col-md-6 form-group">
									<label>Discount Reference By</label>
									<input type="text" name="reference_by" class="form-control">
								</div>	
								<div class="form-group col-md-6">
									<label>After Discount Package Amount</label> <span class="text-nuted">(In Rupees)</span>
									<input type="text" name="net_amount" readonly="readonly" class="form-control">
								</div>	
								<div class="col-md-12 form-group">
									<input type="checkbox" name="checkDate" class="mr-2 checkDate">
									<label>If you want to customize the start date and end date click the checkbox</label>
								</div>					
							</div>
							<div class="row">
								
								<div class="col-md-6 form-group">
									<label>Package Start Date</label>
									<input type="text" name="start_date" class="form-control " data-date-format="yyyy-mm-dd" readonly="readonly">
								</div>
								<div class="col-md-6 form-group">
									<label>Package End Date</label>
									<input type="text" name="end_date" class="form-control " data-date-format="yyyy-mm-dd" readonly="readonly">
								</div>								
							</div>
						
						</div>
						<div class="modal-footer">
							<input type="hidden" name="subscription_id" value="" >
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<input type="submit" class="btn btn-primary" value="Save changes" id="submit">
						</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myTable').DataTable();

		$('#btnAll,#btnNew,#bntRenew').on('click',function(e){
			e.preventDefault();

			var btnId =  $(this).attr('id');
			console.log(btnId);
			$('#btngroup').find('button').removeClass('btn-info').addClass('btn-default');
			$('#'+btnId).addClass('btn-info');

			$.ajax({
				type:'GET',
				url:"{{route('admin.find_subscriptions')}}?btnId="+btnId,
				success:function(res){
					$('#tableBody').empty().html(res);
				}

			})


		})



		$(function () {
			$('.datepicker').datepicker({ 
					setDate: new Date(),
					formate:'YYYY-m-d',
						singleDatePicker: true,
					showDropdowns: true,
			});
		});

		$(document).on('click','#activeModalBtn',function(e){
				e.preventDefault();
			$('#activeModal').modal('show');
			var id = $(this).attr('data-id');
			$('input[name="subscription_id"]').val(id);

		})

		$("#activeForm").submit(function(e){
				e.preventDefault();
			var package_id = $('select[name="package_id"] option:selected' ).val();	
			var discount_status = $('select[name="discount_status"] option:selected' ).val();	
			var discount_perc = $('input[name="discount_perc"]').val();	
			var reference_by  = 	$('input[name="reference_by"]').val();		
			if(package_id != '0'){
				if(discount_status !='0'){
					if(discount_perc !='' && reference_by !=''){
						submitForm();
						return false;
					}else{
						alert('All field are mendatory')
					}
				}else{
					submitForm();
					return false;
				}
				
			}else{
				alert('First select package');
			}
		});
		function submitForm(){
			$.ajax({
				type: "POST",
				url: "{{route('admin.store_subscription')}}",
				cache:false,
				data: $('form#activeForm').serialize(),
				success: function(response){
					$("#activeModal").modal('hide');
					alert("User Plan Active Successfully");
					location.reload();
					//console.log(response);
				},
				error: function(){
					alert("Error");
				}
			});
		}


		$(document).on('change','.discount_status',function(e){
			e.preventDefault();
			var status = $(this).val();
			// console.log(status);
			if(status !=0){
				$('#discountDiv').show();				
			}else{
				$('#discountDiv').hide();
				$('input[name="dicount_amount"]').val(''); 
			   	$('input[name="net_amount"]').val('');
			   	$('input[name="discount_perc"]').val('');
			   	$('input[name="reference_by"]').val('');			   	
			   	$('.percent_error').hide();

			}
		});

		$('.checkDate').click(function() {
			var check = $('.checkDate').prop('checked');		
			if(check){
				$('input[name="start_date"],input[name="end_date"]').addClass('datepicker');
				$('.datepicker').datepicker('update');
			}else{
				$('.datepicker').datepicker('remove');
				$('input[name="start_date"], input[name="end_date"]').removeClass('datepicker');
				// $(".datepicker").datepicker("disable");
				//   $('input[name="start_date"]').datepicker("destroy");
			}
		});

		$(document).on('change','.package',function(e){
			e.preventDefault();
			var id = $(this).val();
			if(id !=0){
				$.ajax({
					type:'GET',
					url:"{{route('admin.package_fetch')}}?id="+id,
					success:function(res){
						var date = new Date(); 
						var start_date = dateFormat(date);

						$('input[name="start_date"]').val(start_date);
						$('input[name="package_amount"]').val(res.price);

						if(res.duration_type == 'month'){				
							var e_date = new Date(date.setMonth(date.getMonth() + parseInt(res.duration)));
							

						}else if(res.duration_type == 'year'){
							var e_date = new Date(date.setFullYear(date.getFullYear() + parseInt(res.duration)));
						}else if(res.duration_type == 'day'){

							var e_date = new Date(date.setDate(date.getDate() + parseInt(res.duration)));
							
						}
						var end_date = dateFormat(e_date);
						$('input[name="end_date"]').val(end_date);
					}
				});
			}else{
				$('input[name="package_amount"]').val('');
				$('input[name="dicount_amount"]').val(''); 
			   	$('input[name="net_amount"]').val('');
			   	$('input[name="discount_perc"]').val('');
			   	$('input[name="reference_by"]').val('');
			   	$('input[name="start_date"], input[name="end_date"]').val('');
			   	$('.percent_error').hide();
			}
		});

		$(document).on('keyup', '.discount_perc', function(e){
			e.preventDefault();
			var package_id = $('select[name="package_id"] option:selected' ).val();	
			var package_amount = $('input[name="package_amount"]' ).val();	
			var percent = $.trim($(this).val());

			var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
    		var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
    		if(package_id !=0){  
    			if(percent !=''){    			
					if(re.test(percent)){  
		    			if(re1.test(percent)){ 
		    				if(percent <= 100){
			    				var d_amount = (package_amount * percent) / 100 ;
			    				var net_amount = package_amount - d_amount;
			    				$('input[name="net_amount"]').val(net_amount);
			    				$('input[name="dicount_amount"]').val(d_amount); 
			    				$('.percent_error').hide();
					    	}else{
					    		$('input[name="dicount_amount"]').val(''); 
			    				$('input[name="net_amount"]').val('');
		    					alert('Oops, you are over 100%');
		    				}

		    			}else{
		    				$('.percent_error').show();
		    			}
		    		}else{
		    			$('.percent_error').show();
		    		}
    				
    			}else{
		    		$('input[name="dicount_amount"]').val(''); 
    				$('.percent_error').hide();
    			}
    			
    		}else{
    			alert('First select package');
    		}
		});

		function dateFormat(date) {
			var day = date.getDate();
		    var month = date.getMonth() + 1;
		    var year = date.getFullYear();
		    if (day < 10) {
		        day = "0" + day;
		    }
		    if (month < 10) {
		        month = "0" + month;
		    }

			var c_date = year + "-" + month  + "-" + day;
			return c_date; 
		}
	})
</script>
@endsection