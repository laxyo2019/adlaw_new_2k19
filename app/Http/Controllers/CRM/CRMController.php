<?php

namespace App\Http\Controllers\CRM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Helpers\Helpers;
use Auth;
use App\User;
use App\Models\UserPackage;
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
}
