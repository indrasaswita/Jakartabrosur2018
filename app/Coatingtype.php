<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coatingtype extends Model
{
	protected $fillable = ['name', 'info', 'description', 'behavior'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];


	public function paper (){
		return $this->hasMany('App\Paper', 'coatingtypeID');
	}
}
