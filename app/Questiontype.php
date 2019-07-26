<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questiontype extends Model
{
	protected $fillable = ['name'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function faquestion(){
		return $this->hasMany('App\Faquestion', 'questiontypeID')->with('employee');
	}
}
