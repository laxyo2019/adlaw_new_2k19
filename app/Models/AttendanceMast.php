<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceMast extends Model
{
    protected $table = 'attendance_mast';
	protected $guarded = [];
	
	public function student(){
		return $this->belongsTo('App\Models\StudentMast','s_id');
	}
}
