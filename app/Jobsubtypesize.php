<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypesize extends Model
{
    protected $fillable = ['jobsubtypeID', 'ofdg', 'sizeID', 'favourite'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function size(){
    	return $this->belongsTo('App\Size', 'sizeID');
    }

    public function jobsubtype(){
    	return $this->belongsTo('App\Jobsubtype', 'jobsubtypeID');
    }
}
