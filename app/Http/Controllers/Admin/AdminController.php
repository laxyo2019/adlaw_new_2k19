<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Permission;
use App\Models\Review;
use App\Models\Status;
use App\Models\ContactUs;
use App\Models\SubcriptionContact;
use App\Models\CourtMastHeader;
use App\Models\Court;
use App\Models\Package;
use App\Models\UserPackage;
use App\Models\TempUsers;
use App\Models\State;
use App\Models\City;
use App\Imports\ExcelImport;
use App\Exports\ExcelUploadErrors;
use Illuminate\Support\Str;
// use App\Exports\StudentErrorExport;
// use App\Exports\StudentDetailExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){

		// $users = User::whereNull('parent_id')->get();
        // $collect = collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','A')->count();
        
		return view('admin.dashboard.dashboard',compact('users'));      
	}
    public function user_data_fetch(){
        $users = User::whereNull('parent_id')->get();

        // return collect($users)->where('user_catg_id','2')->count();
        // return [

        //     // 'user_total'       =>  collect($users)->count(),
        //     // 'user_subscription' => collect($users)->where('user_package_id','!==', null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'user_unsubscription'=> collect($users)->where('user_package_id', null)->count(),
        //     // 'user_delete'       =>User::onlyTrashed()->whereNull('parent_id')->count(),
        //     // 'user_renewal'      => collect($users)->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(),
        //     // 'lawyer_total'  => collect($users)->where('user_catg_id','2')->count()
        //     // 'lawyer_registered'      => collect($users)->where('user_catg_id','2')->where('on_database','0')->count(),
        //     // 'lawyer_import'      => collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','D')->count(),
        //     // 'lawyer_import_reg'      => collect($users)->where('user_catg_id','2')->where('on_database','1')->where('status','!==','D')->count(),
        //     // 'lawyer_subscirption'      => collect($users)->where('user_catg_id','2')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'lawyer_unsubscirption'      => collect($users)->where('user_catg_id','2')->where('user_package_id',null)->count(),
        //     // 'lawyer_renewal'      => collect($users)->where('user_catg_id','2')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(),
        //     // 'lawfirm_total'      => collect($users)->where('user_catg_id','3')->count(),
        //     // 'lawfirm_registered'      => collect($users)->where('user_catg_id','3')->where('on_database','0')->count(),
        //     // 'lawfirm_import'      => collect($users)->where('user_catg_id','3')->where('on_database','1')->where('status','D')->count(),
        //     // 'lawfirm_import_reg'      => collect($users)->where('user_catg_id','3')->where('on_database','1')->where('status','!==','D')->count(),
        //     // 'lawfirm_subscirption'      => collect($users)->where('user_catg_id','3')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'lawfirm_unsubscirption'      => collect($users)->where('user_catg_id','3')->where('user_package_id',null)->count(),
        //     // 'lawfirm_renewal'      => collect($users)->where('user_catg_id','3')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(), 
        //     // 'lawschools_total'      => collect($users)->where('user_catg_id','4')->count(),
        //     // 'lawschools_registered'      => collect($users)->where('user_catg_id','4')->where('on_database','0')->count(),
        //     // 'lawschools_import'      => collect($users)->where('user_catg_id','4')->where('on_database','1')->where('status','D')->count(),
        //     // 'lawschools_import_reg'      => collect($users)->where('user_catg_id','4')->where('on_database','1')->where('status','!==','D')->count(),
        //     // 'lawschools_subscirption'      => collect($users)->where('user_catg_id','4')->where('user_package_id','!==',null)->where('package_end','>',date('Y-m-d'))->count(),
        //     // 'lawschools_unsubscirption'      => collect($users)->where('user_catg_id','4')->where('user_package_id',null)->count(),
        //     // 'lawschools_renewal'      => collect($users)->where('user_catg_id','4')->where('user_package_id','!==', null)->where('package_end','<',date('Y-m-d'))->count(),
        // ];
    }
    public function connectLogin(){
      return redirect('http://chat.adlaw.in/custom-login?email='.Auth::user()->email.'&password='.Auth::user()->password);
    } 


	//show all pending reviews 
	public function pending_reviews(){

		$pending_reviews = DB::table('users')->join('user_reviews', 'user_reviews.user_id','=','users.id')->where('review_status', 'C')->get();

		$active_reviews =Review::join('users','user_reviews.user_id','=','users.id')->where('review_status', 'A')->get();

		return view('admin.dashboard.review', compact('pending_reviews','active_reviews'));
	}
		//approved pending reviews
	public function active_pending_reviews($review_id){

		Review::where('review_id',$review_id)->update(['review_status'=>'A']);

		return redirect()->back();
	}
	//decline one reviews
	public function decline_pending_reviews($review_id){

		Review::where('review_id',$review_id)->update(['review_status'=>'B']);
		return redirect()->back();
	}

	//Approved selected pending reviews

	public function active_all_reviews(Request $request){

		Review::whereIn('review_id',$request->review_ids)->update(['review_status'=>'A']);
		return "Selected reviews approved successfully";
	}
	//Decline selected pending reviews

	public function decline_all_reviews(Request $request){
		Review::whereIn('review_id',$request->review_ids)->update(['review_status'=>'B']);
		return "Selected reviews declined successfully";
	}

	public function bloguser(){
		$bloguser = User::with('role')->get();
		$permission = DB::select('select * from permissions');
		$gotpermision=DB::select('select * from permission_user');
		return view('admin.dashboard.blog.blog_users',compact('bloguser','permission','gotpermision'));
	}
	public function blogpremission(Request $request){
		$userid=$request->user_id;
		$user= User::find($userid);
		$data=$request->hiddenValue;
		foreach($data as $permis){
			$user->attachPermission($permis);
		}  

	}
	public function contact_details(){
		$contacts =  ContactUs::all();
		return view('admin.dashboard.contact.index',compact('contacts'));
	} 

	public function show_subscription(){
		$subscriptions =  SubcriptionContact::with('user.role')->where('active','0')->get();
		$packages = Package::all();
        return view('admin.dashboard.contact.show_subsription',compact('subscriptions','packages'));
    }
    public function find_subscriptions(){
    	$all_subsc =  SubcriptionContact::with('user.role')->where('active','0')->get();
    	if(request()->btnId == 'btnNew'){
			$subscriptions = collect($all_subsc)->filter(function($e){
				return $e->status == 'new';
			});
    	}
    	else if(request()->btnId == 'bntRenew'){
    		$subscriptions = collect($all_subsc)->filter(function($e){
				return $e->status == 'renew';
			});
    	}else{
    		$subscriptions = $all_subsc;
    	}
    	return view('admin.dashboard.contact.table_subscription',compact('subscriptions'));
    }


    public function package_fetch(){
		$package = Package::find(request()->id);
    	return response()->json($package);
    }

 
    public function subscription_package_active(Request $request){
    
    	if($request->btn_id ==''){
    		$subscription =  SubcriptionContact::find($request->subscription_id);
    		$user = User::find($subscription->user_id);
    		$subscription_status = $subscription->status;

    	}else{
    		$user = User::find($request->subscription_id);
    		$subscription_status = $request->btn_id;
    	}

    	$data = [
    		'user_id' => $user->id,
    		'package_id' => $request->package_id,
    		'discount_perc' => $request->discount_perc,
    		'dicount_amount' => $request->dicount_amount ,
    		'net_amount' => $request->net_amount,
    		'reference_by' => $request->reference_by,
    		'package_start' => $request->start_date,
    		'package_end' => $request->end_date,
    	];

    	if($subscription_status == 'renew'){
    		$old_user_package = UserPackage::find($user->user_package_id);
    		$old_user_package->update(['status' => '0']);
    		$old_pack_end = date('Y-m-d',strtotime($old_user_package->package_end));  

    		//This code is used for old package date and now date diff. 

    		$created = new Carbon($old_pack_end);
			$now = Carbon::now();
			$difference = ($now->diff($created)->days < 1)
			    ? 'today'
			    : $now->diffForHumans($created);

		    if($difference != 'today'){
		   		$str_arr = explode(" ",$difference);
		   		$day = $str_arr[0] + 1;
		   		if($str_arr[2] == 'after'){
					$data['package_end'] = date('Y-m-d', strtotime($data['package_end']. ' + '.$day. ' days'));
		   		}
		    }

    	}

    	$user_package = UserPackage::create($data);	  	
	  	$permission_user = User::wherePermissionIs('subscription_package')->where('id',$user->id)->first();

		if(!empty($permission_user)){
			DB::table('permission_user')->where('user_id', $permission_user->id)->where('permission_id','6')->delete();
		}


		$user->attachPermission('6');
		if($request->btn_id ==''){
    		$subscription->update(['active' => '1']);
    	}
    	$user->update(['user_package_id' => $user_package->id , 'package_start' => $data['package_start'], 'package_end' => $data['package_end']]);
    	// Mail::to($subscription->email)->send(new )
    	return "success";
    }
    public function uploadData(){
    	return view('admin.dashboard.upload.index');
    }

    public function importData(Request $request){
    	$request->validate([
    		'type' => 'required|not_in:""',
    		// 'file' => 'required'
    	]);
    	// return Str::random(40);
        $test = [];
        $test1 = [];
    	$status = true;
    	$duplicate = false;
    	$errors = array();
        $datas = Excel::toCollection(new ExcelImport,$request->file('file'));
        // return "hello";
        //  return $datas;
    	foreach($datas as $value){
    		foreach ($value as $data) {
    			$user = array();
    			if($data['name'] !=''){
    				$user['name'] = $data['name'];
    				if($data['contact_no'] !='' || $data['email'] !=''){
    					if($data['contact_no'] !=''){
    						if(is_numeric($data['contact_no'])){
    							if(strlen($data['contact_no']) == '10' || strlen($data['contact_no']) == '11'  ){
    								$oldUser = User::where('mobile',$data['contact_no'])->first();

    								if(!empty($oldUser)){
										$duplicate = true;
									}
    								$user['mobile'] = $data['contact_no'];
								}else{
    								$status = false;
    							}
    						}else{
								$status = false;
							}
    					}
    					if($data['email'] !=''){
    						if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
    							$oldUser = User::where('email',$data['email'])->first();
    							if(!empty($oldUser)){
									$duplicate = true;
								}
								$user['email'] = $data['email'];
								 
    						}else{
								$status = false;
							}
    					}
    				}else{
    					$status = false;
    				}
    				if($status){
    					if($data['state'] !=''){
    						$state = State::where('state_name',$data['state'])->first();
    						if(!empty($state)){
    							if($data['city'] !=''){
    								$city = City::where('city_name',$data['city'])->first();
    								if(!empty($city)){
    									$user['state_code'] = $city->state_code; 
    									$user['city_code'] = $city->city_code; 
    								}else{
    									$status = false;
    								}
    							}else{
    								$status = false;
    							}
    						}else{
    							$status = false;
    						}
    					}else{
    						$status = false;
    					}
    				}
    			}else{
    				$status = false;
    			}
				if($status == true){
					$user['user_catg_id'] = $request->type;
					$user['on_database']  = '1';
					$user['status']  = 'D';
					if($duplicate){

                        // $test1[] = [
                        //     's_no'          => $data['sno'],
                        //     'name'          => $data['name'],
                        //     'contact_no'    => $data['contact_no'],
                        //     'email'         => $data['email'],
                        //     'city'          => $data['city'],
                        //     'state'         => $data['state'],
                        // ];  
                        if(empty($oldUser)){
                         //User::find($oldUser['id'])->update($user);

                        }

				  		
					}else{
                        // $test[] = [
                        //     's_no'          => $data['sno'],
                        //     'name'          => $data['name'],
                        //     'contact_no'    => $data['contact_no'],
                        //     'email'         => $data['email'],
                        //     'city'          => $data['city'],
                        //     'state'         => $data['state'],
                        // ];  

				  		$newuser = User::create($user);
				  	    $court = CourtMastHeader::where('city_code',$user['city_code'])->where('court_type','3')->first();
				  		if(!empty($court)){
				  			Court::insert(['user_id' => $newuser->id,'court_code' => $court->court_code]);
				  		}
				  		
					}
				}else{
					$errors[] = [
						's_no' 		    => $data['sno'],
						'name' 			=> $data['name'],
						'contact_no' 	=> $data['contact_no'],
						'email' 		=> $data['email'],
						'city' 			=> $data['city'],
						'state' 		=> $data['state'],
					];
				}
				$status = true;
				$duplicate = false;
    		}
    	}

    	if(count($errors) !=0){
            return Excel::download(new ExcelUploadErrors($errors), 'error_sheet.xlsx');
        }
        return back()->with('success',"Successfully");

    }
    public function user_appointment(){
        
        return view('admin.dashboard.appointment.index');
    }


    public function reports(){
        $users = User::with(['city','state'])->where('user_catg_id','2')->whereIn('status',['A','C'])->whereNull('parent_id')->orderBy('registration_date','DESC')->get();
        // return $users;
        return view('admin.dashboard.reports.index',compact('users'));
    }

}
