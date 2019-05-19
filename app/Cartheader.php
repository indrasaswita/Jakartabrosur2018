<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cartheader extends Model
{
	//use SoftDeletes;
	
	protected $fillable = ['customerID', 'jobsubtypeID', 'jobtitle', 'quantity', 'quantitytypename', 'customernote', 'itemdescription', 'resellername', 'resellerphone', 'reselleraddress', 'buyprice', 'printprice', 'deliveryprice', 'discount', 'processtype', 'processtime', 'deliveryID', 'deliveryaddress', 'deliverytime', 'totalpackage', 'totalweight', 'filestatus'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];
	protected $hidden = ['deleted_at'];

	public function customer(){
		return $this->belongsTo('App\Customer', 'customerID')->with('company');
	}
	public function jobsubtype(){
		return $this->belongsTo('App\Jobsubtype', 'jobsubtypeID');
	}

	public function cartfile(){
		return $this->hasMany("App\Cartfile", 'cartID')->with('file');
	}

	public function cartpreview(){
		return $this->hasMany('App\Cartpreview', 'cartID')->with('file');
	}

	public function cartdetail(){
		return $this->hasMany("App\Cartdetail", 'cartID')->with('plano', 'vendor', 'paper', 'cartdetailfinishing', 'printer');
	}

	public function salesdetail(){
		return $this->hasMany('App\Salesdetail', 'cartID')->with('salesheader');
	}

	public function delivery(){
		return $this->belongsTo('App\Delivery', 'deliveryID');
	}
}
