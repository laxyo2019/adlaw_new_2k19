<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Referral;
use App\Models\State;

class ReferralController extends Controller
{
    public function index(){
    	$referrals = Referral::with(['state','city'])->get();
    	return view('admin.dashboard.referral.index',compact('referrals'));
    }
    public function create(){
    	$states = State::all();
    	return view('admin.dashboard.referral.create',compact('states'));
    }
    public function store(Request $request){
    	// return rand(11,99);
    	$data = $request->validate([
    		'name' => 'required|min:3|max:255',
    		'email' => ['required', 'string', 'email', 'max:255', 'unique:referrals'],
            'mobile' => ['required','string','max:11','min:10', 'unique:referrals'],
    		'state_code' => 'required|not_in:0',
    		'city_code' =>  'required|not_in:0'
    	]);

    	$referral = Referral::create($data);
    	
    	$referral_code = $referral->city_code.rand(11,99).$referral->id;
    	Referral::find($referral->id)->update(['referral_code' => $referral_code]);
 	
    	return redirect()->route('referral.index')->with('success','Referral User Created Successfully');
    	//return view('admin.dashboard.referral.create');
    }
    public function edit($id){
    	$states = State::all();
    	$referral  = Referral::find($id);
    	return view('admin.dashboard.referral.edit',compact('referral','states'));
    }
    public function update(Request $request,$id){
    	$data = $request->validate([
    		'name' => 'required|min:3|max:255',
    		'email' => ['required', 'string', 'email', 'max:255', 'unique:referrals,email,'.$id],
            'mobile' => ['required','string','max:11','min:10', 'unique:referrals,mobile,'.$id],
    		'state_code' => 'required|not_in:0',
    		'city_code' =>  'required|not_in:0'
    	]);

    	Referral::find($id)->update($data);
    	return redirect()->route('referral.index')->with('success','Referral User Updated Successfully');
    }
    public function delete($id)
	{
		Referral::findOrFail($id)->delete();
		return back()->with('success','Referral User Deleted Successfully');
	}
}
