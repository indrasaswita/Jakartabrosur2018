<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricetype extends Model
{
	protected $fillable = ['name'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function pricelist(){
		return $this->hasMany('App\Pricelist', 'typeID');
	}
}
