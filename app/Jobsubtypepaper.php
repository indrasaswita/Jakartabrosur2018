<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypepaper extends Model
{
    protected $fillable = ['jobsubtypeID', 'paperID', 'ofdg', 'favourite'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function paper(){
    	return $this->belongsTo('App\Paper', 'paperID')->with('paperdetail');
    }

    public function papershop(){
    	return $this->belongsTo('App\Paper', 'paperID')->with('papertype');
    }

    public function jobsubtype(){
    	return $this->belongsTo('App\Jobsubtype', 'jobsubtypeID');
    }
}
