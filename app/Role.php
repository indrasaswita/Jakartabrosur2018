<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = ['name', 'sale', 'purchase', 'delivery', 'workorder', 'customer', 'employee', 'report'];
}
