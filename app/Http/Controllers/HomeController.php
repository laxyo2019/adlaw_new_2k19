<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Customer;
use App\Models\City;
use App\Models\State;
use App\Models\Blog;
use App\Models\CourtType;
use App\Models\CourtMast;
use App\Models\CourtMastHeader;
use App\Models\SubCatgMast;

use App\SendCode1;
use Illuminate\Support\Facades\Hash;
use Crypt;
class HomeController extends Search\SearchController 
{
    public function index(){
        // $blogs = Blog::where('status','A')->limit(5)->get();
        // $blog_id =array();
        // foreach($blogs as $blog){
        // $blog_id[] = $blog->id;
        // }

        // $blogs1 = Blog::whereNotIn('id',$blog_id)->where('status','A')->limit(5)->get();
        // $blog_id1 =array();
        // foreach($blogs1 as $blog1){
        // $blog_id1[] = $blog1->id;
        // }
        // $blog_id2 = array_merge($blog_id,$blog_id1);

        return view('layouts.home');
    }
    // public function home(){
    //     return view('home');
    // }
    public function getStateList(Request $request)
    {
        $states = State::where("country_code",$request->country_id)->orderBy('state_name','ASC')
                    ->get();
        return response()->json($states);
    }
        
    public function getCityList()
    {
      
      $cities = City::where("state_code",request()->state_code)->orderBy('city_name','ASC')->get();
      return response()->json($cities);
    }

    public function getCityListDropDown(Request $request)
    {        
      $data['cities'] = City::where("state_code",$request->state_code)->orderBy('city_name','ASC')->get();

      $data['cityCode'] = auth()->user()->city_code;

         // return  $data['cityCode'];
      return response()->json($data);

    }
    public function getCityListClientDropDown(Request $request){
      $data['cities'] = City::where("state_code",$request->state_code)->get();
      $city = Customer::select('city_code')->where('cust_id',$request->cust_id)->first();

       $data['cityCode'] = $city->city_code;
       return response()->json($data);

    }
    public function courtTypeFilter(Request $request){
       $courts = CourtType::where('court_group_code',$request->court_group_code)->get();
       return response()->json($courts); 
    }
    public function court_category($court_type){
      $courts = CourtMast::where('court_type',$court_type)->orderBy('court_name','ASC')->get();
      return response()->json($courts); 
    }

    public function case_subcategory(){
      $subcategories = SubCatgMast::where('catg_code',request()->catg_code)->get(); 
      return response()->json($subcategories);
    }

    public function all_notifications(){
      return view('notifications.all_notifications');
    }
    public function get_all_users(){
      $user = User::where('email', request('email'))->first();
      if($user){
        echo 'duplicate';
      }
    }

    public function notification_read($id){
      $notification = auth()->user()->unreadNotifications->where('id',$id)->first();
       $notification->markAsRead();
       return redirect($notification->data['url']);
    }
    public function state_city_court(){

      if(request()->state_code ==''){
        $courts = CourtMastHeader::where('city_code',request()->city_code)->get();
      }else{
        $courts = CourtMastHeader::where('state_code',request()->state_code)->get();        
      }
      $court_type = array();
      foreach ($courts as $court) {
        $court_type [] = $court->court_type;

      }
      $court_types = array();

      if(!empty($court_type)){
        $court_types =   CourtType::whereIn('court_type',$court_type)->get();
      }

      return response()->json($court_types);
    }


   public function connectLogin(){

      //return redirect('http://127.0.0.1:8002/custom-login?email='.Auth::user()->email.'&password='.Auth::user()->password);
         // return Redirect("http://connect-adlaw.laxyo.org");

      return redirect('http://chat.adlaw.in/custom-login?email='.Auth::user()->email.'&password='.Auth::user()->password);
        // return Redirect("http://chat.adlaw.in/custom-login");

   } 

   public function connectcj(){

      return redirect('https://courtsjudgments.com/site/signup');
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
      $user->pwd = Crypt::encrypt($request->new_password);
      $user->save();

      $status = 'Password Updated!';
      return redirect()->back()->with('success',$status);
    } else {
      $class = 'alert alert-danger';
      $status = 'Old password incorrect!';
      return redirect()->back()->with('warning',$status);
    }

  }

  public function refreshCaptcha()
  {
      return response()->json(['captcha'=> captcha_img('flat')]);
  }


  public function verified_account(){
    $user = User::find(Auth::user()->id);
    if($user->on_database == '1'){

    }else{
      
    }
  }

  public function message_sent(){
    return view('admin.dashboard.message');
  }

  public function message_sent_store(Request $request){

    $users =  User::where('user_catg_id','2')->where('state_code','21')->whereNotNull('mobile')->where('message_sent','0')->take('500')->get();

    // return $users;
      foreach ($users as $key => $value) {
        $sendData = [
            'message' => $request->message,
            'mobile' => $value->mobile 
        ]; 

        SendCode1::sendCode($sendData);  
        User::find($value->id)->update(['message_sent' => '1']);
          
      }

  // die;

// return redirect()->back()->with('success','Message Sent Successfully');

    return "success";
  }
  public function testphone(){

        // $username="ritesh845";
        // $password ="ritesh@100";
        // $number = '7828773421';
        // $sender = "TESTID";
        // $message = rand(1111,9999);
     
        // $url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($username)."&password=".urlencode($password)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 



    //   $url =  "http://login.yourbulksms.com/api/sendhttp.php?authkey=11456AxEiTIeN5ca87c66&mobiles=7828773421&message=test & new&mobile&sender=ADLAWR&route=4";
    // // $url = "http://login.yourbulksms.com/api/balance.php?authkey=11456AxEiTIeN5ca87c66&type=1";

    //     $ch = curl_init($url);

    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     echo $curl_scraped_page = curl_exec($ch);

    //     curl_close($ch); 
    //   return $url;
    //     return rand(1111,9999);
  }


}
