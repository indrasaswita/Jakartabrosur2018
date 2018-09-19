<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salespaymentverif extends Model
{
    protected $fillable = ['paymentID', 'note', 'employeeID', 'veriftime'];
    protected $guarded = ['id'];

   	public function salespayment(){
   		return $this->belongsTo('App\Salespayment', 'paymentID')->with('salesheader');
   	}

   	public function employee(){
   		return $this->belongsTo('App\Employee', 'employeeID')->with('role');
   	}
}
