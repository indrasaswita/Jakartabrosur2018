<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ['name', 'sale', 'purchase', 'delivery', 'workorder', 'customer', 'employee', 'report'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function employee(){
		return $this->hasMany('App\Employee', 'roleID');
	}
}
