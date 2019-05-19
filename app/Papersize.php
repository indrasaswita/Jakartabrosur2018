<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Papersize extends Model
{
    protected $fillable = ['width', 'length'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    protected function paperdetail(){
    	return $this->hasMany('App\Paperdetail', 'planoID')->with('paper', 'vendor');
    }
}
