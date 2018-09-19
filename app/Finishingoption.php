<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finishingoption extends Model
{
    protected $fillable = ['finishingID', 'optionname', 'price', 'priceper', 'priceminim', 'pricebase', 'processdays', 'info'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function finishing()
    {
    	return $this->belongsTo('App\Finishing', 'finishingID');
    }
}
