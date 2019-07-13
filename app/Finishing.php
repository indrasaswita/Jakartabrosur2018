<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
    protected $fillable = ['name', 'shortname', 'status', 'info', 'mingram', 'maxgram', 'onesideinschietOF', 'twosideinschietOF', 'onesideinschietDG', 'twosideinschietDG'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = ['status'];

    public function finishingoption(){
    	return $this->hasMany('App\Finishingoption', 'finishingID');
    }

}
