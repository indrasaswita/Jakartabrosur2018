<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypedetailpaper extends Model
{
    protected $fillable = ['jobsubtypedetailID', 'ofdg', 'paperID'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function paper(){
    	return $this->belongsTo('App\Paper', 'paperID')->with('paperdetail');
    }

    public function jobsubtypedetail(){
    	return $this->belongsTo('App\Jobsubtypedetail', 'jobsubtypedetailID');
    }
}
