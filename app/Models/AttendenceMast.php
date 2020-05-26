<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendenceMast extends Model
{
	protected $table = 'attendence_mast';
	protected $guarded = [];
	
	public function student(){
		return $this->belongsTo('App\Models\StudentMast','s_id');
	}
}
