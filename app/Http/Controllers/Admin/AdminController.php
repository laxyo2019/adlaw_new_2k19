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
use App\Models\Package;
use App\Models\UserPackage;
class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$users = User::whereNull('parent_id')->get();

		return view('admin.dashboard.dashboard',compact('users'));      
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
        return view('admin.dashboard.contact.show_subsription',compact('subscriptions','packages','renew_subscriptions','new_subscriptions'));
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
}
