<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Papertype extends Model
{
    protected $fillable = ['name', 'category'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function paper(){
    	return $this->hasMany('App\Paper','papertypeID');
    }
}
