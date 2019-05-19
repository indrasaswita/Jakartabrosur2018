<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['nickname', 'name', 'phone1', 'phone2', 'phone3', 'type', 'verified'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function customer(){
    	return $this->hasMany('App\Customer', 'companyID')->with('customeraddress');
    }

    public function companyaddress(){
    	return $this->hasMany('App\Companyaddress','companyID')->with('address');
    }
}
