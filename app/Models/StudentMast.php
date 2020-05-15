<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMast extends Model
{
    protected $table = 'student_mast';
    protected $guarded = [];

    // public function qual_catg(){
    // 	return $this->belongsTo('App\Models\QualCatg','qual_catg_code');
    // }
    public function qual_course(){
    	return $this->belongsTo('App\Models\QualMast','qual_code');
    }
    public function batch(){
    	return $this->belongsTo('App\Models\BatchMast','batch_id');
    }
    public function stu_qual_details(){
    	return $this->hasMany('App\Models\StudentQual','s_id');
    }
    public function stud_guardians(){
        return $this->hasMany('App\Models\GuardianMast','s_id');
    }
    public function stud_addresses(){
        return $this->hasMany('App\Models\StudentAddress','s_id');
    }
    public function stud_docs(){
        return $this->hasMany('App\Models\StudentDocs','s_id');
    }
    public function reservation(){
        return $this->belongsTo('App\Models\ReservationClass','reservation_class_id');
    }
    public function religion(){
        return $this->belongsTo('App\Models\Religion','religion_id');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country','nationality_id');
    }
    public function language(){
        return $this->belongsTo('App\Models\LanguageMast','language_id');
    }
}
