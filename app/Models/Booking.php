<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "bookings" ;
	protected $guarded = [];

	public function users(){
		return $this->belongsTo('App\User','client_id');
	}
		
}
