<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
	use SoftDeletes;

  protected $fillable = ['owner', 'ownerID', 'icon', 'title', 'content', 'viewed'];
  protected $guarded = ['id'];
  protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  protected $hidden = ['deleted_at'];

  public function customer(){
  	return $this->belongsTo('App\Customer', 'ownerID');
  }

  public function employee(){
  	return $this->belongsTo('App\Employee', 'ownerID');
  }
} 
