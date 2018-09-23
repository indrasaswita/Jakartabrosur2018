<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $fillable = ['name', 'address', 'cityID', 'addressnotes'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function customeraddress(){
		return $this->hasMany('App\CustomerAddress','addressID'));
	}

	public function city(){
		return $this->belongsTo('App\City','cityID');
	}

	public function companyaddress(){
		return $this->hasMany('App\companyaddress', 'AddressID');
	}
}
