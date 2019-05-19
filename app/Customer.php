<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $fillable = ['companyID', 'email', 'password', 'name', 'type', 'title', 'postcode', 'phone1', 'phone2', 'phone3', 'news', 'balance', 'remember_token', 'verify_token', 'app_token'];
	protected $guarded = ['id'];
	protected $hidden = ['password', 'balance', 'remember_token'];
	protected $dates = ['created_at', 'updated_at'];
	protected $casts = ['news'];

	public function company (){
		return $this->belongsTo('App\Company', 'companyID')->with('companyaddress');
	}

	public function salesheader(){
		return $this->hasMany('App\Salesheader', 'customerID')->with('salesdetail', 'salespayment', 'salesdelivery');
	}

	public function customerbankacc(){
		return $this->hasMany('App\Customerbankacc', 'customerID')->with('bank');
	}

	public function customeraddress(){
		return $this->hasMany('App\Customeraddress', 'customerID')->with('address');
	}

	public function onesignal(){
		return $this->hasMany('App\Onesignal', 'ownerID')->where('ownertype', 'CU');
	}

}
