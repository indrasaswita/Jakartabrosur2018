<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customeronesignal extends Model
{
	protected $fillable = ['onesignalID', 'customerID', 'count', 'app_token'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function onesignal(){
		return $this->belongsTo('App\Onesignal', 'onesignalID');
	}

	public function customer(){
		return $this->belongsTo('App\Customer', 'customerID')->with('company');
	}
}
