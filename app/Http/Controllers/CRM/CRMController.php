<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Helpers\Helpers;
use Auth;
use App\User;
use App\Models\UserPackage;
use App\Notifications\SubscriptionReminder;
class CRMController extends Controller
{
    public function index(){

    	$modules = Module::all();
    	$package_id = Auth::user()->user_package_id;
	    $moduleShow = false;
	    $beforeDate = '';
	      if($package_id != '' ){
	        $today = date('Y-m-d');
	    	$package_end = Auth::user()->package_end;
	 		$beforeDate = date('Y-m-d', strtotime(Auth::user()->package_end.'-7 days'));
	    
	        $end_date = date('Y-m-d',strtotime(Auth::user()->package_end));
	        if(strtotime($today) <= strtotime($end_date)){
	           $moduleShow = true;
	        }
	      }

	    $user_package = UserPackage::with('package')->where('user_id',Auth::user()->id)->where('status','1')->first();
	    $oldpackages = UserPackage::with('package')->where('user_id',Auth::user()->id)->where('status','0')->first();
    	return view('CRM.index',compact('modules','moduleShow','user_package','beforeDate','oldpackages'));
    }

    public function old_subscription_package(){

	    $oldpackages = UserPackage::with('package')->where('user_id',request()->id)->where('status','0')->get();
	    return $oldpackages;
    }

	public function expired_subscription(){ 
		$from = date("Y-m-d");
		$to = date("Y-m-d",strtotime("+7 days"));
		
		$users = User::whereBetween('package_end',[$from,$to])->whereNull('parent_id')->get();

		foreach ($users as $user) {
			$data = [
				'id' => $user->id,
	            'title' => 'Subscription Package Expire',
	            'url' => 'crm_dashboard' ,
	            'message' => (date('d',strtotime($user->package_end)) - date('d') > 0 ? ('After ' . ( date('d',strtotime($user->package_end)) - date('d')) . ' days your subscription package expire') : (date('d',strtotime($user->package_end)) - date('d') == 0 ? 'Today your subscription package expire' : 'Your subscription package expired')) ,
			];
			// return $data;
			$user->notify(new SubscriptionReminder($data));
		}
	}
}
