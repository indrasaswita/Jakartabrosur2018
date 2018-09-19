<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
    protected $fillable = ['name', 'shortname', 'status', 'side', 'info'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function finishingoption(){
    	return $this->hasMany('App\Finishingoption', 'finishingID');
    }

    public function finishingoptionShop(){
    	return $this->hasMany('App\Finishingoption', 'finishingID')->select('id', 'optionname', 'processdays', 'info', 'finishingID');
    }
}
