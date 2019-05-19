<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['bankname', 'alias', 'code'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function customerbankacc(){
    	return $this->hasMany('App\Customerbankacc', 'bankID');
    }

    public function companybankacc(){
    	return $this->hasMany('App\Companybankacc', 'bankID');
    }
}
