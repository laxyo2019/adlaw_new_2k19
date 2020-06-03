<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\BatchMast;
use App\Models\StudentMast;
use App\Models\AttendanceMast;
use App\Models\QualCatg;
use App\Models\QualMast;
use App\Models\AcademicCalendarMast;
use App\Notifications\AttendanceNotifications;
// use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentAttendenceExport;
use App\Imports\AttendanceImport;
class AttendanceController extends Controller
{
    public function index(){
    	return view('attendance.index');
    }
    public function student_attendance(){
        $data = $this->details();
       	return view('attendance.student.index',compact('data'));
    }
    public function student_fetch(Request $request){

     //    $students = AttendanceMast::
    	$students = $this->filter($request)->get();

        $attendance_students = AttendanceMast::where('attendance_date',date('Y-m-d'))->whereIn('s_id',collect($students)->pluck('id'))->get();
        // return $attendance_students;
    	return view('attendance.student.table',compact('students','attendance_students'));
    }
    public function attendance_submit(Request $request){
        $present_students = $request->present_student;
        $total_students = $request->total_student;

        if(Auth::user()->hasRole('lawcollege')){
            $user_id = Auth::user()->id;
            $submitted_by = $user_id;
        }else{
            $user_id = Auth::user()->parent_id;
            $submitted_by = Auth::user()->id;
        }  

        $attendance = AttendanceMast::whereIn('s_id',$total_students)->where('attendance_date',date('Y-m-d'))->get();  

        $absent_students = array_diff($total_students, $present_students);

        // return $absent_students;

        if(count($attendance) == 0){
                $data = [
                    'user_id'         => $user_id,
                    'submitted_by'    => $submitted_by,
                    'attendance_date' => date('Y-m-d')
                ];
            foreach ($absent_students as $absent_student) {
                $data['s_id'] = $absent_student;
                $data['present'] = 'A';
                AttendanceMast::create($data);
            }
            foreach ($present_students as $present_student) {       
                $data['s_id'] = $present_student;
                $data['present'] = 'P';
                AttendanceMast::create($data);
            }
            if(Auth::user()->hasRole('teacher')){
                $user = User::find(Auth::user()->parent_id);
                $message = [
                    'id' => '',
                    'title' => 'attendance Submit',
                    'url' => 'attendance/dashboard',
                    'message' => 'Students attendance submitted' 
                ];
                $user->notify(new attendanceNotifications($message));
            }
            return 'success';
        }else{
            return "warning";
        }
    }

    public function staff_attendance(){
        if(Auth::user()->hasRole('lawcollege')){
            $users = User::whereRoleIs('teacher')->where('parent_id',Auth::user()->id)->get();
        }else{
            $users = User::whereRoleIs('teacher')->where('parent_id',Auth::user()->parent_id)->get(); 
        }

        return view('attendance.staff.index',compact('users'));
    }
    public function manage_attendance(){
        $data = $this->details();

        return view('attendance.manage.index',compact('data')); 
    }
    public function student_filter(Request $request){
        $students = $this->filter($request)->get();
        
        if(count($students) !=0){
            $attendance_students = AttendanceMast::with('student')->where('attendance_date',$request->attendance_date)->whereIn('s_id',collect($students)->pluck('id'))->get();
        }else{
            $attendance_students = [];
        }

        return view('attendance.manage.table',compact('students','attendance_students'));
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
    public function show_attendance($id){
        $student = StudentMast::find($id);
        return  view('attendance.manage.show',compact('student'));
    } 
    public function attendance_list(Request $request){
        $attendances = AttendanceMast::where('s_id',$request->s_id)->whereBetween('attendance_date',array($request->start_date,$request->end_date))->get();  
        return view('attendance.manage.list',compact('attendances'));
    }

    public function attendance_update(Request $request){

        $present_students = $request->present_student;
        $total_students = $request->total_student;

        if(Auth::user()->hasRole('lawcollege')){
            $user_id = Auth::user()->id;
            $submitted_by = $user_id;
        }else{
            $user_id = Auth::user()->parent_id;
            $submitted_by = Auth::user()->id;
        }  

        $data = [
            'user_id'         => $user_id,
            'submitted_by'    => $submitted_by,
            'attendance_date' => date('Y-m-d')
        ];
        if($present_students !=null){
            $absent_students = array_diff($total_students, $present_students);
        }
        else{
            $absent_students = $total_students;
        }
            foreach ($absent_students as $absent_student) {
                $data['s_id'] = $absent_student;
                $data['present'] = 'A';
                AttendanceMast::where('s_id',$absent_student)->where('attendance_date',$request->attendance_date)->update(['present' => 'A']);
            }
        if($present_students !=null){
            foreach ($present_students as $present_student) {       
                $data['s_id'] = $present_student;
                $data['present'] = 'P';
                AttendanceMast::where('s_id',$present_student)->where('attendance_date',$request->attendance_date)->update(['present' => 'P']);
            }
        }

        return 'success';
    }
    public function attendance_upload(){
        return view('attendance.upload.index');
    }
    public function attendance_report(){
        $data = $this->details();
        return view('attendance.report.index',compact('data'));
    }
    public function report_generate(Request $request){
       $data =  $request->validate([
            'qual_catg_code' => 'required|not_in:""',
            'qual_code' => 'required|not_in:""',
            'batch' => 'required|not_in:""',
            'year' => 'required|not_in:""',
            'semester' => 'required|not_in:""',
            'attendance_date' => 'required',
        ],
        [
            'qual_catg_code.*' => 'Qualification Type field is required', 
            'qual_code.*' => 'Qualification subcategory field is required', 
            
        ]
    );

        $attendance_date = $request->attendance_date;
        $year = date('Y',strtotime($attendance_date));
        $month = date('m',strtotime($attendance_date));   

        $month1 = Carbon::createFromFormat('Y-m', $request->attendance_date);
        $monthStart = $month1->startOfMonth()->copy();
        $monthEnd = $month1->endOfMonth()->copy();


        $students = $this->filter($request)->with(['attendances' => function($query) use ($year, $month){
            $query->whereYear('attendance_date',$year)->whereMonth('attendance_date',$month);
        }])->get();      
        
        $calendarData = AcademicCalendarMast::whereYear('date_from',$year)
                            ->whereMonth('date_from',$month)
                            ->whereYear('date_upto',$year)
                            ->whereMonth('date_upto',$month)
                            ->where('user_id', Auth::user()->id)
                            ->get();

        $academic_dates = [];
        $monthDates = [];
        $weekendDays =['Sunday'];


        foreach ($calendarData as $key => $value) {
           for($date = $value->date_from->copy() ; $date->lte($value->date_upto); $date->addDay()){
                if(!in_array($date->dayName, $weekendDays)){
                    $symbol = 'H';
                    if($value->is_exam == '1'){
                        $symbol = 'E';
                    }
                    $academic_dates[$date->format('Y-m-d')]= $symbol;
                }
           }
        }

// return $academic_dates;
        for($date =$monthStart; $date->lte($monthEnd) ; $date->addDay() ){
            $weekend = 0;
            if(in_array($date->dayName, $weekendDays)){
                $weekend = 1;
            }
            $monthDates[$date->format('Y-m-d')] = [
                'day' =>  intval($date->format('d')),
                'weekend' => $weekend
            ];
        }
       $headerData = [
            'monthYear' => $month1->format('F, Y')
       ];

       $qual = QualMast::find($request->qual_code);

       $filter = [
            'qual' => $qual->qual_catg_desc,
            'qual_catg' => $qual->qual_desc,
            'year' => $request->year,
            'semester'=>$request->semester,
            'batch' => BatchMast::find($request->batch)->name
       ];

        return  view('attendance.report.clone',compact('monthDates','academic_dates','students','headerData','filter','data'));

        $exportData = [
            'monthDates' => $monthDates,
            'academic_dates' => $academic_dates,
            'students' => $students,
            'headerData' => $headerData,
            'filter' => $filter,
            'data' => $data,
        ];

       return Excel::download(new StudentAttendenceExport($exportData), 'sheet.xlsx');



         
    }

    public function details(){
        $qual_catgs = QualCatg::where('qual_catg_code', '!=',4)->get();

        if(Auth::user()->hasRole('lawcollege')){
           $batches = BatchMast::where('user_id',Auth::user()->id)->orderBy('name','DESC')->get();
        }else{
           $batches = BatchMast::where('user_id',Auth::user()->parent_id)->orderBy('name','DESC')->get();
        }
        return [
            'qual_catgs' => $qual_catgs,
            'batches' => $batches,
        ];
    }
    public function importAttendence(Request $request){
        
        $datas = Excel::toCollection(new AttendanceImport,$request->file('file'));
        return $datas;
    }
}
