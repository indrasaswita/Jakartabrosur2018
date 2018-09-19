<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salespayment extends Model
{
		protected $fillable = ['salesID', 'customeraccID', 'companyaccID', 'paydate', 'note', 'ammount', 'type'];

		public function customeracc()
		{
			//return null;
			return $this->belongsTo('App\Customerbankacc', 'customeraccID')->with('bank');
		}
		public function companyacc()
		{
			return $this->belongsTo('App\Companybankacc', 'companyaccID')->with('bank');
		}
		public function salespaymentverif()
		{
			return $this->hasOne('App\Salespaymentverif', 'paymentID')->with('employee');
		}

		public function salesheader(){
			return $this->belongsTo('App\Salesheader', 'salesID')->with('salesdetail');
		}
}
