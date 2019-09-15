<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeeonesignal extends Model
{
	protected $fillable = ['onesignalID', 'employeeID', 'count', 'app_token'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function onesignal(){
		return $this->belongsTo('App\Onesignal', 'onesignalID');
	}

	public function employee(){
		return $this->belongsTo('App\Employee', 'employeeID')->with('role');
	}
	
}
