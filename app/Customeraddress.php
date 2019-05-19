<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customeraddress extends Model
{
	protected $fillable = ['customerID', 'addressID'];

	protected $guarded = ['id'];
	protected $dates = ['created_at','updated_at'];

	public function customer(){
		return $this->belongsTo('App\Customer', 'customerID');	
	}

	public function address(){
		return $this->belongsTo('App\Address', 'addressID')->with('city');
	}
}
