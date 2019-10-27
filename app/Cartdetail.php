<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartdetail extends Model
{
	protected $fillable = ['cartID', 'cartname', 'jobtype', 'printerID', 'inschiet', 'inschiettypename', 'paperID', 'vendorID', 'planoID', 'printwidth', 'printlength', 'imagewidth', 'imagelength', 'sideprint', 'employeenote', 'totaldruct', 'totalplano', 'totalinplano', 'totalinplanox', 'totalinplanoy', 'totalinplanorest', 'totalinprint', 'totalinprintx', 'totalinprinty', 'totalinprintrest', 'totalpaperprice', 'created_at', 'updated_at'];
	protected $guarded = ['id'];
	protected $hidden = ['created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at'];

	public function printer(){
		return $this->belongsTo('App\Printingmachine', 'printerID');
	}
	public function plano(){
		return $this->belongsTo('App\Papersize', 'planoID');
	}
	public function machine(){
		return $this->belongsTo('App\Printingmachine', 'printerID');
	}
	public function vendor(){
		return $this->belongsTo('App\Vendor', 'vendorID');
	}
	public function paper(){
		return $this->belongsTo('App\Paper', 'paperID')->with('papertype');
	}
	public function cartdetailfinishing(){
		return $this->hasMany('App\Cartdetailfinishing', 'cartdetailID')->with('finishing', 'finishingoption');
	}
}
