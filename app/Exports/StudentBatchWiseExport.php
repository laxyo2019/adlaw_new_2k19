<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Auth;
use App\Models\StudentMast;

class StudentBatchWiseExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
	use Exportable;
	public $request;
	public function __construct($request){
		$this->request = $request;
	}
    public function query()
    {
    	$data = StudentMast::with('qual_catg','qual_course','batch','reservation','country','language')->where('batch_id',$this->request->batch_id)->where('user_id',Auth::user()->id);

    	if($this->request->batch_id !='' && $this->request->qual_year !=''  && $this->request->semester !=''){
    		$data = $data->where('qual_year',$this->request->qual_year)
    					->where('semester',$this->request->semester);	
    	}
    	elseif ($this->request->batch_id !='' && $this->request->qual_year) {
    		$data = $data->where('qual_year',$this->request->qual_year);
    	}
        
        return $data;
    }
    public function map($data) : array
    {
    	return [
    		$data->qual_catg->shrt_desc,
    		$data->qual_course->qual_desc,
    		$data->qual_year,
    		$data->batch->name,
    		$data->semester,
    		date('Y-m-d',strtotime($data->addm_date)),
    		$data->enroll_no,
    		$data->roll_no,
    		$data->status == 'R' ? 'R' : ($data->status == 'P' ? 'P' : 'F'),
    		$data->passout_date !='' ? date('Y-m-d',strtotime($data->passout_date)) : '',
    		$data->f_name,
    		$data->m_name,
    		$data->l_name,
    		$data->mobile,
    		$data->dob,
    		$data->email,
    		$data->gender,
    		$data->reservation->name,
    		$data->religion != null ? $data->religion->name : '',
    		($data->blood_group == '1' ? 'A+' : ($data->blood_group == '2' ? 'A-' : ($data->blood_group == '3' ? 'B' : ($data->blood_group == '4' ? 'B-' : ($data->blood_group == '5' ? 'O+' : ($data->blood_group == '6' ? 'O-' : ($data->blood_group == '7' ? 'AB+' : ($data->blood_group == '8' ? 'AB-' : '')))))))),
    		$data->spec_ailment,
    		$data->country !=null ? $data->country->nationality : '',
    		$data->taluka,
    		$data->language !=null ? $data->language->name : '',
    		$data->s_ssmid,
    		$data->f_ssmid,
    		$data->aadhar_card,
    		$data->bank_name,
    		$data->bank_branch,
    		$data->account_name,
    		$data->account_no,
    		$data->ifsc_code,

    	];
    }
    public function headings() : array
    {
    	 return [
            'qualification_name',
			'course_name',
			'year_of_admission',
			'admission_batch',
			'semester',
			'admission_date',
			'enrollment_no',
			'roll_no',
			'student_status',
			'passout_date',
			'first_name',
			'middle_name',
			'last_name',
			'mobile_no',
			'date_of_birth',
			'email',
			'gender',
			'cast_category',
			'religion',
			'blood_group',
			'specific_ailment',
			'nationality',
			'taluka',
			'mother_tongue',
			'student_ssmid',
			'family_ssmid',
			'aadhar_no',
			'bank_name',
			'bank_branch',
			'account_name',
			'account_no',
			'ifsc_code'
        ];
    }
}
