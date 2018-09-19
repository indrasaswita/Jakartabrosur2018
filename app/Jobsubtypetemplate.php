<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypetemplate extends Model
{
	protected $fillable = ['name', 'fullname', 'description', 'jobsubtypeID', 'ofdg', 'paperID', 'sizeID', 'sideprint', 'preview', 'color'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function jobsubtype(){
		return $this->belongsTo('App\Jobsubtype', 'jobsubtypeID')->with('jobtype');
	}

	public function paper(){
		return $this->belongsTo('App\Paper', 'paperID')->with('papertype');
	}

	public function size(){
		return $this->belongsTo('App\Size', 'sizeID');
	}

	public function jobsubtypetemplatefinishing(){
		return $this->hasMany('App\Jobsubtypetemplatefinishing', 'jobsubtypetemplateID')->with('finishing', 'finishingoption');
	}
}
