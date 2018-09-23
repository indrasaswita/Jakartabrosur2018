<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartfile extends Model
{
    protected $fillable = ["cartID", 'fileID'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    public function file(){
    	return $this->belongsTo('App\Files', 'fileID')->with("customer");
    }

    public function cartheader(){
    	return $this->belongsTo('App\Cartheader', 'cartID');
    }

}
