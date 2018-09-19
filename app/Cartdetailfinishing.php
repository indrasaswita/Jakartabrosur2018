<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartdetailfinishing extends Model
{
    protected $fillable = ['cartdetailID', 'finishingID', 'optionID', 'quantity', 'buyprice', 'sellprice', 'side'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function cartdetail(){
    	return $this->belongsTo('App\Cartdetail', 'cartdetailID');
    }

    public function finishing(){
    	return $this->belongsTo('App\Finishing', 'finishingID');
    }

    public function finishingoption(){
    	return $this->belongsTo('App\Finishingoption', 'optionID');
    }
}
