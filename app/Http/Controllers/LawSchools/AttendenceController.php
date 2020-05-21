<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\BatchMast;
use App\Models\StudentMast;
class AttendenceController extends Controller
{
    public function index(){
    	return view('attendence.index');
    }
    public function student_attendence(){
    	$batches = BatchMast::where('user_id',Auth::user()->id)->orderBy('name','DESC')->get();
    	return view('attendence.student_attendence',compact('batches'));
    }
    public function student_fetch(Request $request){
    	$students = StudentMast::with('batch')
    							->where('batch_id',$request->batch)
                                ->where('qual_year',$request->year)
                                ->where('semester',$request->semester)
                                ->where('status','R')
                                ->orderBy('f_name','ASC');
        if(Auth::user()->parent_id ==null){
        	$students = $students->where('user_id',Auth::user()->id);
        }else{
        	$students = $students->where('user_id',Auth::user()->parent_id);
        }                        
    
    	$students = $students->select('id','f_name','l_name','enroll_no','roll_no','batch_id')->get();
    	return view('attendence.student_attendence_table',compact('students'));
    }
}
