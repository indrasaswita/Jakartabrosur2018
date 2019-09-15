<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricetext extends Model
{
	protected $fillable = ['jobsubtypeID', 'customerID', 'employeeID', 'pricetext', 'totalprice'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];


	public function customer(){
		return $this->belongsTo('App\Customer', 'customerID')->with('company');
	}

	public function employee(){
		return $this->belongsTo('App\Employee', 'employeeID')->with('role');
	}

	public function jobsubtype(){
		return $this->belongsTo('App\Jobsubtype', 'jobsubtypeID');
	}
}
