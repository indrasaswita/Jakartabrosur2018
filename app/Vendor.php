<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
	protected $fillable = ['name', 'phone1', 'phone2', 'salestype', 'address', 'cityID', 'salesname'];
	protected $guarded = ['id'];
	protected $hidden = ['created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at'];
}
