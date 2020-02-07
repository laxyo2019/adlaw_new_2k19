<?php

namespace App\Http\Controllers\Teams;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;
use Auth;
use App\User;
use App\Role;
use App\VerifyUser;
use App\Mail\UserMail;
use App\Models\Status;
use App\Models\RoleUser;
use App\Models\CaseLawyer;
use App\Helpers\Helpers;
class UsersController extends Controller
{
	public function index(){
		$users = User::with(['state','city','country','role'])->whereNull('parent_id')->get();
		$roles = Role::whereNotIn('id',['1','6','7','8'])->get();
        return view('users.index',compact('users','roles'));	
	}
	public function create(){
		$roles = Role::whereNotIn('id',['1','6','7','8'])->get();
		return view('users.create',compact('roles'));
	}
	public function store(Request $request){

		//return $request->all();
		if(Auth::user()->user_catg_id == '1'){
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users',
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	            'user_catg_id'  => 'required|not_in:0',
	        ]);			
	        $data['parent_id'] = null;

		}
		else{
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users',
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	        ]);	

	        if(Auth::user()->user_catg_id == '4'){
	            $data['user_catg_id'] =  '6';
	        }
	        else if(Auth::user()->user_catg_id == '3' || Auth::user()->user_catg_id == '2'){
	            $data['user_catg_id'] = '2';   
	        }else{
	        	$data['user_catg_id'] = '5';   
	        }


	        $data['parent_id'] = Auth::user()->id;
	        $data['user_package_id'] = Auth::user()->id;
	        $data['parent_id'] = Auth::user()->id;

		}

		// return $data;
        $this->create_user($data);

		if(Auth::user()->user_catg_id == '1'){
			return redirect()->route('users.index')->with('success','User created successfully');
		}
		else{
			return redirect()->route('teams.index')->with('success','User created successfully');
		}
       
	}

    public function show($id){
    	$users = Helpers::get_all_users($id)->get();    		
    	return view('users.show',compact('users'));
    }
    public function edit($id){
    	$user = User::find($id);
    	$roles = Role::where('id','>', 1)->get();
        return view('users.edit',compact('countries','user','roles'));
    }
    public function update(Request $request, $id){
    	$olduser = User::find($id);

    	if(Auth::user()->user_catg_id == '1'){
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users,email,'.$id,
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	            'user_catg_id'  => 'required|not_in:0',
	        ]);			
	        $data['parent_id'] = null;

		}
		else{
			$data =  $request->validate([
	            'name'          => 'required|string|max:255|min:3',
	            'email'         => 'required|email|max:255|unique:users,email,'.$id,
	            'mobile'        => 'required|min:10|max:11|regex:/^[0-9]+$/',
	        ]);	

	        if(Auth::user()->user_catg_id == '4'){
	            $data['user_catg_id'] =  '6';
	        }
	        else if(Auth::user()->user_catg_id == '3' || Auth::user()->user_catg_id == '2'){
	            $data['user_catg_id'] = '2';   
	        }else{
	        	$data['user_catg_id'] = '5';   
	        }
	        $data['parent_id'] = Auth::user()->id;
	        $data['user_package_id'] = Auth::user()->id;
	        $data['parent_id'] = Auth::user()->id;
		}

		if($olduser->email != $data['email']){         
            $this->create_user($data,$olduser->email);
        }
        else{
            $olduser->update($data);
        }

        if(Auth::user()->user_catg_id == '1'){
			return redirect()->route('users.index')->with('success','User updated successfully');
		}
		else{
			return redirect()->route('teams.index')->with('success','User updated successfully');
		}

    }
    public function destroy($id){
		VerifyUser::where('user_id',$id)->delete();
		RoleUser::where('user_id',$id)->delete();
		User::find($id)->delete();
		return redirect()->back()->with('success','User deleted successfully');
    }
    public function create_user($data,$oldEmail =null){
        $status = Status::all();
        $status_id = $status[2]->status_id;

        $password  = str_limit($data['name'],3,'@845');
        $data['password'] = Hash::Make($password);
        $data['status']    = $status_id;
        if($oldEmail !=null){
		  $user = User::where('email',$oldEmail)->first();
          $user->update($data); 
        }else{
        	$user = User::create($data);
        	$user->attachRole($user->user_catg_id);
        }
        
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);
        $user['password'] = $password;
        Mail::to($user->email)->send(new UserMail($user));
    }

    public function login_history(){
		$id =  request()->id;
		$user =  User::find($id);
		return response()->json($user);
    }
    public function member_cases(){
       $id =  request()->id;
       $user =  User::find($id);
       // return $member;
      $case = CaseLawyer::with(['case.client','case.court','case.casetype'])->where('user_id1',$id)->where('deallocate_date',null)->get();

    //   CaseLawyer::with(['member','case' => function($query){
				// $query->with(['client','court','casetype']);
				// }])

       return response()->json($case);
    }
    public function password_change(){
    	return view('auth.passwords.change_password');
    }
   public function changePassword(Request $request)
	{
		$request->validate([
			'new_password' => 'min:8|required_with:confirm_password|same:confirm_password',
			'confirm_password' => 'min:8'
		]);

		$user = User::find(auth()->user()->id);

		if(Hash::check($request->old_password, $user->password)) {
			$user->password = bcrypt($request->new_password);
			$user->save();

			$status = 'Password Updated!';
			return redirect()->back()->with('success',$status);
		} else {
			$class = 'alert alert-danger';
			$status = 'Old password incorrect!';
			return redirect()->back()->with('warning',$status);
		}
	
	}
}
