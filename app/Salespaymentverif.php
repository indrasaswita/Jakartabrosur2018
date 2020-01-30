<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salespaymentverif extends Model
{
    protected $fillable = ['paymentID', 'customerbankmutationID', 'note', 'employeeID', 'veriftime'];
    protected $guarded = ['id'];
    protected $dates = ['veriftime', 'created_at', 'updated_at'];

   	public function salespayment(){
   		return $this->belongsTo('App\Salespayment', 'paymentID')->with('salesheader');
   	}

   	public function employee(){
   		return $this->belongsTo('App\Employee', 'employeeID')->with('role');
   	}
}
