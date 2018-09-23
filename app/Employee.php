<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable=['name', 'email', 'password', 'roleID'];
	protected $guarded = ['id'];
	protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at'];

	public function role(){
		return $this->belongsTo('App\Role', 'roleID');
	}

}
