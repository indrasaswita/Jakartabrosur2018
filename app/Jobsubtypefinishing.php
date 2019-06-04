<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypefinishing extends Model
{
    protected $fillable = ['jobsubtypeID', 'ofdg', 'finishingID', 'mustdo'];
    protected $guarded = ['id'];
    protected $casts = ['mustdo'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function finishing()
    {
    	return $this
            ->belongsTo("App\Finishing", 'finishingID')
            ->with(array('finishingoption' => function($query){
                    $query->orderBy('optionname', 'ASC');
            }));
    }

    public function finishingshop(){
    	return $this->belongsTo('App\Finishing', 'finishingID')->with('finishingoptionshop');
    }

    public function jobsubtype(){
        return $this->belongsTo('App\jobsubtype', 'jobsubtypeID');
    }
}
