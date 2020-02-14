<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\VerifyMail;
use DB;
use Mail;
use App\Role;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
      protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_category' => 'required|not_in:0', 
            'captcha' => 'required|captcha'

        ],
        [
            'captcha.captcha'=>'Invalid captcha code.'
        ]
    );


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

         $status = DB::table('status_mast')->select('*')->get();
         $status_id = $status[2]->status_id;
      
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_catg_id'=>$data['user_category'],
                'status'=>$status_id,
            ]);
            $user->attachRole(request()->user_category);

      

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new VerifyMail($user));

        return $user;

    }

    public function verifyUser($token)
    {
       $status = DB::table('status_mast')->select('*')->get();
       
       $result = json_decode(json_encode($status, true));
       foreach($result as $key => $value)
            {
                $result[$key] = (array) $value;
            }  

      $verifyUser = VerifyUser::where('token', $token)->first();

        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if($user->status== $result[2]['status_id']) {
                $verifyUser->user->status = $result[0]['status_id'];
                $verifyUser->user->save();
                $success = $result[0]['status_text'];
            }else{
                $success = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('success', $success);
    }

    

  public function showRegistrationForm()
    {
        $user_catgs = Role::whereNotIn('id',['1','6','7','8'])->get();

        return view('auth.register', compact('user_catgs'));
    }
    
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
         $status = DB::table('status_mast')->select('*')->where('status_id','c')->get();
            foreach($status as $status){
               $status_text = $status->status_text;
            }
        return redirect('/login')->with('success',$status_text);
    }
    
   
    
}   