<?php

namespace App\Http\Controllers\Package;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Auth;
class PackageController extends Controller
{
    public function index(){
    	$packages = Package::all();
    	return view('package.index',compact('packages'));
    }
    public function show($id){
    	$package = Package::with('modules.module')->where('id',$id)->first();
    	// return $package;
    	return view('package.show',compact('package'));

    }
    public function store(Request $request){	
  //   	$package = Package::find($request->package_id);

  // //   	$posted = [
  // //   		'merchant_key' : 'nnkWHEXA',
  // //   		'salt' : 'HxWgYD3fv9',
		// //     'txnid' => substr(hash('sha256', mt_rand() . microtime()), 0, 20), # Transaction ID.
		// //     'amount' => $package->price, # Amount to be charged.
		// //     'productinfo' => $package->name,
		// //     'firstname' => "Adlaw", # Payee Name.
		// //     'email' => "salonij245@gmail.com", # Payee Email Address.
		// //     'phone' => "7828773421", # Payee Phone Number.
		// // ];



  //   	return view('package.pay_form',compact('posted'));
    	// return $package;

    }
    public function payumoney(){

    }
    public function payment_success(){

    }
    
}
