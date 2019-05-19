<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable=['name', 'email', 'password', 'roleID', 'remember_token', 'app_token'];
	protected $guarded = ['id'];
	protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at'];

	public function role(){
		return $this->belongsTo('App\Role', 'roleID');
	}

	public function onesignal(){
		return $this->hasMany('App\Onesignal', 'ownerID')->where('ownertype', 'EM');
	}

}
