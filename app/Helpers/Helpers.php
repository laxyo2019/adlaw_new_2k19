<?php 
namespace App\Helpers;

use Auth;
use App\Models\Customer;
use App\User;
use App\Models\CaseMast;
use App\Models\CourtMastHeader;
use App\Models\Todo;
class Helpers 
{
	public static function deletedClients(){
		$id = Auth::user()->id;
		$client_datas  = Customer::onlyTrashed()->where('user_id',$id)->get();
		$client_ids = array();

		foreach($client_datas as $client_data){
			$client_ids[] = $client_data->cust_id;
		}
		return $client_ids;
	}
	public static function bytesToHuman($bytes)
	{
	    $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

	    for ($i = 0; $bytes > 1024; $i++) {
	        $bytes /= 1024;
	    }

	    return round($bytes, 2) ;
	}
	public static function lawyerDetails($court_id , $speciality_code, $city_code = null){
		$query = User::with(['reviews'=>function ($query) {
			           $query->where('review_status','A');
			        }])->with('city', 'state','slots')			        
			        ->where('status','A')
			        ->where('user_catg_id',2)
			        ->whereNull('parent_id');

		if($court_id !=null){
			$courts_code = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code',$city_code)->get();
		}
			        
		if($court_id != 0 && $speciality_code !=0){
			
			$result = $query->with(['specialities'=>function($query) use($speciality_code){
                          $query->with('specialization_catgs')->where('user_specialization.catg_code',$speciality_code);
                        }])->with(['user_courts'=>function($query) use($courts_code){
                          $query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
                        }]);
		}
		else if ($court_id !=0) {
			$result = $query->with(['specialities'=>function($query){
			          		$query->with('specialization_catgs');
			       		}])->with(['user_courts'=>function($query) use($courts_code){
                          $query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
                        }]);
		}
		else if($speciality_code !=0){
			$result = $query->with(['specialities'=>function($query) use($speciality_code){
                          	$query->with('specialization_catgs')->where('user_specialization.catg_code',$speciality_code);
                        }])->with(['user_courts'=>function($query){
			          			$query->with('court_catg');
			        	}]);
		}
		else{
			$result = $query->with(['specialities'=>function($query){
			          	$query->with('specialization_catgs');
			           }])->with(['user_courts'=>function($query){
			          			$query->with('court_catg');
			        }]);
		}
			
			        
        return $result;
	}
	
	public static function lawcompanyDetails($court_id = null,$city_code = null){
		$query = User::with(['reviews'=>function ($query) {
			           $query->where('review_status','A');
			        }])
					->with('city', 'state')			        
			        ->where('status','A')
			        ->where('user_catg_id',3);

		if($court_id !=null){
			$courts_code = CourtMastHeader::select('court_code')->where('court_type',$court_id)->where('city_code',$city_code)->get();
		}	        

		if($court_id == null){
			$result = $query->with(['user_courts'=>function($query){
			          	 $query->with('court_catg');
			        }]);
		}else{
			$result = $query->with(['user_courts'=>function($query) use($courts_code){
                          $query->with('court_catg')->whereIn('user_courts.court_code',$courts_code->toArray());
                        }]);
		}
			      
		return $result;
	}
	public static function lawschools(){
		$query = User::with(['reviews'=>function ($query) {
		            $query->where('review_status','A');
		    }])->with('city', 'state')
		    ->where('user_catg_id',4)
		    ->where('status','A');
		return $query;
	}


	public static function valid_email($email) {
         return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }
	
	public static function isIfscCodeValid($ifsc_code){
	     return (!preg_match("/^[A-Za-z]{4}0[A-Z0-9]{6}$/", $ifsc_code)) ? FALSE : TRUE;
	}
	public static function cases($del_client){
		$query = CaseMast::with('casetype','client')                 
                        ->whereNotIn('cust_id',$del_client);
      
        return $query;
	}	
	public static function user_all_todos(){
		  $query = Todo::with(['created_user' => function($query){
                 $query->select('id','name');
            }])->with(['assigned_user' => function($query){
                 $query->select('id','name');
            }])->with(['relate_to_case'=>function($query){
            	$query->select('case_id','case_title');
            }]);
            return $query;
	}

	public static function filter_student($students, $status){
    	return collect($students)->filter(function($e) use($status){
    			return $e['status'] == $status;
    	});
    }
    public static function get_all_users($id){ //parent_id_null
    	$user = User::find($id);
		$users = User::where('parent_id',$id)->orderBy('name', 'asc');
		if($user->user_catg_id == '4'){
			$users = $users->where('user_catg_id','6');
		}
        else if($user->user_catg_id == '3' || $user->user_catg_id == '2'){
			$users = $users->where('user_catg_id','2');
     
        }else{
			$users = $users->where('user_catg_id','5');
        }
        return $users;
    } 

    public static function user_package_check(){
    	$moduleShow = false;
		$package_id = Auth::user()->user_package_id;
		$beforeDate = '';

		if($package_id != '' ){
	        $today = date('Y-m-d');
	    	$package_end = Auth::user()->package_end;
	 		$beforeDate = date('Y-m-d', strtotime(Auth::user()->package_end.'-15 days'));
	        $end_date = date('Y-m-d',strtotime(Auth::user()->package_end));
	        if(strtotime($today) <= strtotime($end_date)){
	           $moduleShow = true;
	        }
	    }

	    return ['moduleShow' => $moduleShow, 'beforeDate' => $beforeDate];
    }
}
