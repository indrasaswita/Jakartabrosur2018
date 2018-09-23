<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['nickname', 'name', 'phone1', 'phone2', 'phone3', 'type', 'verified'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function customer(){
    	return $this->hasMany('App\Customer', 'companyID');
    }

    public function companyadress(){
    	return $this->hasMany('App\CompanyAddress','companyID');
    }
}
