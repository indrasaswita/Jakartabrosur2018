<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
	protected $fillable = ['name', 'phone1', 'phone2', 'salestype', 'addressID', 'salesname'];
	protected $guarded = ['id'];
	protected $hidden = ['created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at'];

	public function address(){
		return $this->belongsTo('App\Address', 'addressID');
	}
}
