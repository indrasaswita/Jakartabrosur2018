<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesdetail extends Model
{
	protected $fillable = ['salesID', 'cartID', 'statusfile', 'commited', 'statusctp', 'statusprint', 'statuspacking', 'statusdelivery', 'statusdone'];
	protected $guarded = ['id'];
	protected $hidden = ['created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at'];

	public function salesheader(){
		return $this->belongsTo('App\Salesheader', 'salesID');
	}

	public function cartheader(){
		return $this->belongsTo("App\Cartheader", 'cartID')->with('customer', 'jobsubtype', 'cartdetail', 'cartfile', 'delivery', 'cartpreview');
		}
	public function salesdeliverydetail(){
		return $this->hasMany('App\Salesdeliverydetail', 'salesdetailID');
		}
}
