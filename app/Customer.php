<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['companyID', 'email', 'password', 'name', 'type', 'title', 'address', 'postcode', 'cityID', 'phone1', 'phone2', 'phone3', 'news', 'balance'];
    protected $hidden = ['password', 'balance', 'remember_token'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function company (){
    	return $this->belongsTo('App\Company', 'companyID')->with('city');
    }

    public function city(){
    	return $this->belongsTo("App\City", 'cityID');
    }

    public function salesheader(){
    	return $this->hasMany('App\Salesheader', 'customerID')->with('salesdetail', 'salespayment', 'salesdelivery');
    }

    public function customerbankacc(){
        return $this->hasMany('App\Customerbankacc', 'customerID')->with('bank');
    }
}
