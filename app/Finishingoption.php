<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finishingoption extends Model
{
    protected $fillable = ['finishingID', 'optionname', 'price', 'priceper', 'priceminim', 'pricebase', 'processdays', 'info', 'defaultoption'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = ['defaultoption'];

    public function finishing()
    {
    	return $this->belongsTo('App\Finishing', 'finishingID');
    }
}
