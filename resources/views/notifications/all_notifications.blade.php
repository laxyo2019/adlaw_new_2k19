@extends('lawfirm.main')

@section('content')
<section class="content">
  <div class="row">
    {{-- <div class="col-md-3">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Categories</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="{{Request()->segment(1) == 'message' ? 'active' : ''}}"><a href="#"><i class="fa fa-inbox"></i> Inbox  </a></li>
            	
            <li class="{{Request()->segment(1) == 'sent_messages' ? 'active' : ''}}"><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
          
          </ul>
        </div>
      
      </div>
     
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Labels</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
          </ul>
        </div>
 
      </div> --}}
      <!-- /.box -->
    </div>
    <div class="col-md-12">
	  <div class="box box-primary">
	    <!-- <div class="box-header with-border">
	      <h3 class="box-title">All Notifications</h3>
	    </div> -->
	    <!-- /.box-header -->
	    <div class="box-body table-responsive">
	    	<!-- <div class="row">
	    		<div class="col-md-12">
		    		<div class="mailbox-controls">
	                <button class="btn btn-default btn-sm">
	                	<input type="checkbox" id="checkAll" >
	                </button>
	                <div class="btn-group">
	                	<button type="button" class="btn btn-default btn-sm" id="trashBtn" ><i class="fa fa-trash-o"></i></button>	                  
	                </div>
	                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
	              </div>
	    		</div>
	    	</div> -->
	 
	         <table class="table table-striped">
				<thead>
					<tr class="text-muted">
						<th>Notifications</th>
						
					</tr>
				</thead>
				@forelse(Auth::user()->unreadNotifications as $notification)
				<tbody>
					<tr>
						<td>
							<li>
			                     <a href="{{route('todos.show',$notification['data']['id'])}}">
			                        <i class="fa fa-tasks "></i> 

			                        <span> {{str_limit($notification['data']['title'], $limit = 50, $end = '...') }} </span>
			                        <br>
			                        <span>{{$notification['data']['message']}}</span>
			                       
			                        <br> <span>{{$notification['created_at']->diffForHumans()}}</span>
			                    </a>
			                  </li>
			                 @empty
			                  	<li class="text-center">Records not found</li>
			                 @endforelse	
						</td>
					</tr>
				</tbody>
				<!-- table body is here -->
			</table>  
			
		</div>
	</div>
  </div>
</section>

<!-- <script>
	$(document).ready(function(){
		 $.ajaxSetup({
		      headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		      }
   		});
		$('#messageTable').DataTable();

		$("#checkAll").click(function(){
		    $('input:checkbox').not(this).prop('checked', this.checked);
		});
		$("#trashBtn").on('click',function(e){
			e.preventDefault();
			var msgIds = [];
			$.each($("input[name='msg']:checked"),function() {
				msgIds.push($(this).val());
			});

			if(msgIds.length == 0){
				swal({
			          text: 'Select message',
			          icon: 'warning'
	   			});
			}
			else{				  
				swal({
					title: "Are you sure ??",
					text: "Are you sure you want to delete messages permanently", 
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
						type:'get',
						url: '{{route('message.delete')}}?msgIds='+msgIds,
						success:function(data){
						swal({
						    text : data,
						    icon : 'success',
						  });
						  setTimeout(function(){// wait for 5 secs(2)
						     location.reload(); // then reload the page.(3)
						  }, 2000); 
					}
				});
				} else {
					swal("Your messages is safe!");
					}					      
				});			
			}
		});
	});
	
</script> -->
@endsection