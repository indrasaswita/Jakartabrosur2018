<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cartpreview extends Model
{
	use SoftDeletes;

  protected $fillable = ['cartID', 'fileID', 'commit', 'comment'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $guarded = ['id'];

  public function file(){
  	return $this->belongsTo('App\Files', 'fileID');
  }

  public function cartheader(){
  	return $this->belongsTo('App\Cartheader', 'cartID');
  }
}
