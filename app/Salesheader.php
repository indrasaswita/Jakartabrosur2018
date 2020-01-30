<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salesheader extends Model
{
	use SoftDeletes;

	protected $fillable = ['customerID', 'name', 'tempo', 'estdate'];
	protected $guarded = ['id'];
	protected $dates = ['tempo', 'estdate', 'created_at', 'updated_at', 'deleted_at'];

	public function customer(){
		return $this->belongsTo('App\Customer', 'customerID')->with('company', 'customeraddress');
	}

	public function salesdetail(){
		return $this->hasMany("App\Salesdetail", 'salesID')->with('cartheader', 'salesdeliverydetail');
	}

	public function salespayment(){
		return $this->hasMany("App\Salespayment", 'salesID')->with('customeracc', 'companyacc', 'salespaymentverif');
	}

	public function salesdelivery(){
		return $this->hasMany("App\Salesdelivery", 'salesID')->with('salesdeliverydetail');
	}
}
