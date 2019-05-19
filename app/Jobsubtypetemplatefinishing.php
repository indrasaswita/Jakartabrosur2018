<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypetemplatefinishing extends Model
{
	protected $fillable = ['jobsubtypetemplateID', 'finishingID', 'optionID'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function finishing(){
		return $this->belongsTo('App\Finishing', 'finishingID');
	}

	public function finishingoption(){
		return $this->belongsTo('App\Finishingoption', 'optionID');
	}
}
