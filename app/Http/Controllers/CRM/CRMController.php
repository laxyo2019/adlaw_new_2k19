<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Helpers\Helpers;
use Auth;
use App\User;
use Mail;
use App\Models\UserPackage;
use App\Notifications\SubscriptionReminder;
use App\Mail\SubscriptionReminderMail;
class CRMController extends Controller
{
    public function index(){

    	$modules = Module::all();
    	$package_id = Auth::user()->user_package_id;

	    $packageCheck =  Helpers::user_package_check();
		$moduleShow = $packageCheck['moduleShow'];
		$beforeDate = $packageCheck['beforeDate'];

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
		$to = date("Y-m-d",strtotime("+15 days"));
		
		$users = User::whereBetween('package_end',[$from,$to])->whereNull('parent_id')->get();

		foreach ($users as $user) {
			$data = [
				'id' => $user->id,
	            'title' => 'Subscription Package Expire',
	            'url' => 'crm_dashboard' ,
	            'message' => (date('d',strtotime($user->package_end)) - date('d') > 0 ? ('After ' . ( date('d',strtotime($user->package_end)) - date('d')) . ' days your subscription package expire') : (date('d',strtotime($user->package_end)) - date('d') == 0 ? 'Today your subscription package expire' : 'Your subscription package expired')) ,
			];
			// return $user->email;
			$user->notify(new SubscriptionReminder($data));

			if(date('d',strtotime($user->package_end)) - date('d') == 15){
				Mail::to($user->email)->send(new SubscriptionReminderMail($data));

			}else if(date('d',strtotime($user->package_end)) - date('d') == 7){
				Mail::to($user->email)->send(new SubscriptionReminderMail($data));
				
			}else if(date('d',strtotime($user->package_end)) - date('d') == 0){
				Mail::to($user->email)->send(new SubscriptionReminderMail($data));
			}

		}
	}
}
