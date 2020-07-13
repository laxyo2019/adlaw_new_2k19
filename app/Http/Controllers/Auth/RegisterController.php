<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Mail\VerifyMail;
use App\SendCode;
use DB;
use Mail;
use App\Role;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Referral;
class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

   

    protected function validator(array $data,$id)
    {
        // return $data;
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'mobile' => ['required','string','max:11','min:10', 'unique:users,mobile,'.$id],
            'user_category' => 'required|not_in:0',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => 'required|captcha',
            'referral_code' => 'nullable|exists:referrals'
        ],
        [
            'captcha.captcha'=>'Invalid captcha code.'
        ]);
    }


    public function register(Request $request)
    {
        $email = User::where('email',$request->email)->where('on_database','1')->first();
        $mobile = User::where('mobile',$request->mobile)->where('on_database','1')->first();
        $id = null;

        if(!empty($email) || !empty($mobile)){
            if(!empty($email)){
                $id = $email->id;
            }else{
                $id = $mobile->id;

            }
        }
     

        $this->validator($request->all(),$id)->validate();

        event(new Registered($user = $this->create($request->all(),$id)));
        // $this->guard()->login($user);
        return $this->registered($request, $user)
                        ?: redirect('/verify?phone='.$request->mobile)->with('success','We sent activation code, Check your mobile and also check your email and click on the link to verify your email');
    }

    protected function create(array $data,$id)
    {

        $status = DB::table('status_mast')->select('*')->get();
        $status_id = $status[2]->status_id;

        if($id ==null){
            $user =  User::create([
                'name'          => $data['name'],
                'email'         => $data['email'],
                'password'      => Hash::make($data['password']),
                'mobile'        => $data['mobile'],
                'user_catg_id'  => $data['user_category'],
                'status'        => $status_id,
                'pwd'           => Crypt::encrypt($data['password']),
                'referral_code' => $data['referral_code']
            ]);
        }else{
            $user = User::find($id);
            $user->name             = $data['name'];
            $user->email            = $data['email'];
            $user->password         = Hash::make($data['password']);
            $user->mobile           = $data['mobile'];
            $user->user_catg_id     = $data['user_category'];
            $user->status           = $status_id;
            $user->pwd              = Crypt::encrypt($data['password']);
            $user->referral_code    = $data['referral_code'];
            $user->save();
        }
                      
        if($user){
            $user->attachRole(request()->user_category);
            $user->otp = SendCode::sendCode($user->mobile);
            $user->remember_token = str_random(40);
            $user->save();

            Referral::where('referral_code',$data['referral_code'])->increment('summary_count','1');
            Mail::to($user->email)->send(new VerifyMail($user));
        }

    }


    // protected function create(array $data)
    // {

    //      $status = DB::table('status_mast')->select('*')->get();
    //      $status_id = $status[2]->status_id;
      
    //     $user = User::create([
    //         'name'          => $data['name'],
    //         'email'         => $data['email'],
    //         'password'      => Hash::make($data['password']),
    //         'mobile'        => $data['mobile'],
    //         'user_catg_id'  => $data['user_category'],
    //         'status'        => $status_id,
    //     ]);
    //     $user->attachRole(request()->user_category);

    //     $verifyUser = VerifyUser::create([
    //         'user_id' => $user->id,
    //         'token' => str_random(40)
    //     ]);

    //     Mail::to($user->email)->send(new VerifyMail($user));

    //     return $user;

    // }

    // public function verifyUser($token)
    // {
    //    $status = DB::table('status_mast')->select('*')->get();
       
    //    $result = json_decode(json_encode($status, true));
    //    foreach($result as $key => $value)
    //         {
    //             $result[$key] = (array) $value;
    //         }  

    //   $verifyUser = VerifyUser::where('token', $token)->first();

    //     if(isset($verifyUser) ){
    //         $user = $verifyUser->user;
    //         if($user->status== $result[2]['status_id']) {
    //             $verifyUser->user->status = $result[0]['status_id'];
    //             $verifyUser->user->save();
    //             $success = $result[0]['status_text'];
    //         }else{
    //             $success = "Your e-mail is already verified. You can now login.";
    //         }
    //     }else{
    //         return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
    //     }

    //     return redirect('/login')->with('success', $success);
    // }

    

    public function showRegistrationForm()
    {
        $user_catgs = Role::whereNotIn('id',['1','6','7','8'])->get();

        return view('auth.register', compact('user_catgs'));
    }
    
    // protected function registered(Request $request, $user)
    // {
    //     $this->guard()->logout();
    //      $status = DB::table('status_mast')->select('*')->where('status_id','c')->get();
    //         foreach($status as $status){
    //            $status_text = $status->status_text;
    //         }
    //     return redirect('/login')->with('success',$status_text);
    // }  
    
}   