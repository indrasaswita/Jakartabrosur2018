<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypedetailfinishing extends Model
{
    protected $fillable = ['jobsubtypedetailID', 'ofdg', 'finishingID'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function finishing(){
    	return $this->belongsTo('App\Finishing', 'finishingID')->with('finishingoption');
    }

    public function finishingshop(){
    	return $this->belongsTo('App\Finishing', 'finishingID')->with('finishingoptionshop');
    }

    public function jobsubtypedetail(){
    	return $this->belongsTo('App\Jobsubtypedetail', 'jobsubtypedetailID');
    }
}
