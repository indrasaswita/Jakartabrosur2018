<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companyaddress extends Model
{
    protected $fillable = ['companyID', 'addressID'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function company(){
    	return $this->belongsTo('App\Company','companyID');
    }

    public function address(){
    	return $this->belongsTo('App\Address','addressID');
    }
}
