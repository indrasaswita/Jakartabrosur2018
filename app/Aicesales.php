<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aicesales extends Model
{
    protected $fillable= ['icecreamID', 'qty', 'sellprice', 'updated_at'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function icecream()
    {
    	return $this->belongsTo('App\Icecream', 'icecreamID');
    }
}
