<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faquestion extends Model
{
	protected $fillable = ['title', 'favourite', 'description', 'questiontypeID', 'linkheader', 'linkurl', 'employeeID'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];


	public function employee(){
		return $this->belongsTo('App\Employee', 'employeeID');
	}

	public function questiontype(){
		return $this->belongsTo('App\QuestionType', 'questiontypeID');
	}
}
