<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onesignal extends Model
{
	protected $fillable = ['devicename', 'player_id', 'active'];
	protected $casts = ['active'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function customeronesignal(){
		return $this->hasOne('App\Customeronesignal', 'onesignalID')->with('customer');
	}

	public function employeeonesignal(){
		return $this->hasOne('App\Employeeonesignal', 'onesignalID')->with('employee');
	} 
}
