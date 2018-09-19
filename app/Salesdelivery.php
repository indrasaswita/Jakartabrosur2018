<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesdelivery extends Model
{
    protected $fillable = ['salesID', 'deliveryID', 'employeeID', 'address', 'receiver', 'customernote', 'employeenote', 'suratimage', 'suratno', 'arrivedtime'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['arrivedtime', 'created_at', 'updated_at'];

    public function salesdeliverydetail(){
    	return $this->hasMany('App\Salesdeliverydetail', 'salesdeliveryID')->with('salesdetail');
    }

    public function employee(){
    	return $this->belongsTo('App\Employee', 'employeeID')->with('role');
    }

    public function salesheader(){
    	return $this->belongsTo('App\Salesheader', 'salesID')->with('salesdetail', 'salespayment', 'customer');
    }

    public function delivery(){
        return $this->belongsTo('App\Delivery', 'deliveryID');
    }
}
