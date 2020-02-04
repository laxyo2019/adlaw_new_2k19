<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\User;
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
		return view('admin.dashboard.dashboard');      
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
    public function store_subscription(Request $request){
		$subscription =  SubcriptionContact::find($request->subscription_id);
    	$user = User::find($subscription->user_id);

    	$data = [
    		'user_id' => $subscription->user_id,
    		'package_id' => $request->package_id,
    		'discount_perc' => $request->discount_perc,
    		'dicount_amount' => $request->dicount_amount,
    		'net_amount' => $request->net_amount,
    		'reference_by' => $request->reference_by,
    		'package_start' => $request->start_date,
    		'package_end' => $request->end_date,
    	];

    	
    	if($subscription->status == 'renew'){
    		UserPackage::find($user->user_package_id)->update(['status' => '0']);

    	}
    	$user_package = UserPackage::create($data);
	  	
    	$subscription->update(['active' => '1']);
    	$user->update(['user_package_id' => $user_package->id , 'package_start' => $request->start_date, 'package_end' => $request->end_date]);
    	// Mail::to($subscription->email)->send(new )
    	return "success";


    }
}
