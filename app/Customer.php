<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $fillable = ['companyID', 'email', 'password', 'name', 'type', 'title', 'postcode', 'phone1', 'phone2', 'phone3', 'news', 'balance'];
	protected $guarded = ['id'];
	protected $hidden = ['password', 'balance', 'remember_token'];
	protected $dates = ['created_at', 'updated_at'];

	public function company (){
		return $this->belongsTo('App\Company', 'companyID')->with('address');
	}

	public function salesheader(){
		return $this->hasMany('App\Salesheader', 'customerID')->with('salesdetail', 'salespayment', 'salesdelivery');
	}

	public function customerbankacc(){
		return $this->hasMany('App\Customerbankacc', 'customerID')->with('bank');
	}

	public function customeraddress(){
		return $this->hasMany('App\CustomerAddress', 'customerID');
	}
}
