<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Models\BatchMast;
use App\Models\StudentMast;
use App\Models\AttendenceMast;
use App\Models\QualCatg;
use App\Notifications\AttendenceNotifications;
class AttendenceController extends Controller
{
    public function index(){
    	return view('attendence.index');
    }
    public function student_attendence(){
        $qual_catgs = QualCatg::where('qual_catg_code', '!=',4)->get();

        if(Auth::user()->hasRole('lawcollege')){
    	   $batches = BatchMast::where('user_id',Auth::user()->id)->orderBy('name','DESC')->get();
        }else{
           $batches = BatchMast::where('user_id',Auth::user()->parent_id)->orderBy('name','DESC')->get();
        }

    	return view('attendence.student_attendence',compact('batches','qual_catgs'));
    }
    public function student_fetch(Request $request){

     //    $students = AttendenceMast::
    	$students = $this->filter($request)->get();

        $attendence_students = AttendenceMast::where('attendence_date',date('Y-m-d'))->whereIn('s_id',collect($students)->pluck('id'))->get();
        // return $attendence_students;
    	return view('attendence.student_attendence_table',compact('students','attendence_students'));
    }
    public function attendence_submit(Request $request){
        $present_students = $request->present_student;
        $total_students = $request->total_student;

        if(Auth::user()->hasRole('lawcollege')){
            $user_id = Auth::user()->id;
            $submitted_by = $user_id;
        }else{
            $user_id = Auth::user()->parent_id;
            $submitted_by = Auth::user()->id;
        }  

        $attendence = AttendenceMast::whereIn('s_id',$total_students)->where('attendence_date',date('Y-m-d'))->get();  

        $absent_students = array_diff($total_students, $present_students);

        // return $absent_students;

        if(count($attendence) == 0){
                $data = [
                    'user_id'         => $user_id,
                    'submitted_by'    => $submitted_by,
                    'attendence_date' => date('Y-m-d')
                ];
            foreach ($absent_students as $absent_student) {
                $data['s_id'] = $absent_student;
                $data['status'] = 'A';
                AttendenceMast::create($data);
            }
            foreach ($present_students as $present_student) {       
                $data['s_id'] = $present_student;
                $data['status'] = 'P';
                AttendenceMast::create($data);
            }
            if(Auth::user()->hasRole('teacher')){
                $user = User::find(Auth::user()->parent_id);
                $message = [
                    'id' => '',
                    'title' => 'Attendence Submit',
                    'url' => 'attendence/dashboard',
                    'message' => 'Students attendence submitted' 
                ];
                $user->notify(new AttendenceNotifications($message));
            }
            return 'success';
        }else{
            return "warning";
        }
    }

    public function staff_attendence(){
        if(Auth::user()->hasRole('lawcollege')){
            $users = User::whereRoleIs('teacher')->where('parent_id',Auth::user()->id)->get();
        }else{
            $users = User::whereRoleIs('teacher')->where('parent_id',Auth::user()->parent_id)->get(); 
        }

        return view('attendence.staff_attendence',compact('users'));
    }
    public function manage_attendence(){
        $qual_catgs = QualCatg::where('qual_catg_code', '!=',4)->get();

        if(Auth::user()->hasRole('lawcollege')){
           $batches = BatchMast::where('user_id',Auth::user()->id)->orderBy('name','DESC')->get();
        }else{
           $batches = BatchMast::where('user_id',Auth::user()->parent_id)->orderBy('name','DESC')->get();
        }

        return view('attendence.manage_attendence',compact('qual_catgs','batches')); 
    }
    public function student_filter(Request $request){
        $students = $this->filter($request)->get();
        // $attendence_students = AttendenceMast::with('student')->whereBetween('attendence_date',array($request->start_date,$request->end_date))->whereIn('s_id',collect($students)->pluck('id'))->get();

        return view('attendence.manage_attendence_table',compact('students'));
    }

    public function filter($request){
        $students = StudentMast::with('batch')
                        ->select('id','f_name','l_name','enroll_no','roll_no','batch_id')
                        ->where('qual_catg_code',$request->qual_catg_code)
                        ->where('qual_code',$request->qual_code)
                        ->where('batch_id',$request->batch)
                        ->where('qual_year',$request->year)
                        ->where('semester',$request->semester)
                        ->where('status','R')
                        ->orderBy('f_name','ASC');
        if(Auth::user()->hasRole('lawcollege')){
            $students = $students->where('user_id',Auth::user()->id);
        }else{
            $students = $students->where('user_id',Auth::user()->parent_id);
        }       
        return $students;
    }
}
