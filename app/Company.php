<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
		protected $guarded = ['id'];
    protected $fillable = ['nickname', 'name', 'address', 'cityID', 'phone1', 'phone2', 'phone3', 'type', 'verified'];
    protected $dates = ['created_at', 'updated_at'];

    public function city(){
    	return $this->belongsTo('App\City', 'cityID');
    }

    public function customer(){
    	return $this->hasMany('App\Customer', 'companyID');
    }
}
