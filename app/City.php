<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function address(){
    	return $this->hasMany('App\Address', 'cityID');
    }
}
