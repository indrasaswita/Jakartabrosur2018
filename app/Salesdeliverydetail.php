<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesdeliverydetail extends Model
{
  protected $fillable = ['salesdetailID', 'salesdeliveryID', 'actualprice', 'quantity', 'weight', 'totalpackage', 'status'];
  protected $guarded = ['id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $dates = ['created_at', 'updated_at'];

  public function salesdelivery(){
  	return $this->belongsTo('App\Salesdelivery', 'salesdeliveryID');
  }

  public function salesdetail(){
  	return $this->belongsTo('App\Salesdetail', 'salesdetailID')->with('cartheader');
  }

  public function scopeOfSalesID($query, $salesID){
  	return $query->whereIn('salesdeliveryID', function($subquery){
  			$subquery->from('salesdeliveries')
  				->select('id')
					->where('salesID', $salesID);
  		}
  	);
  }
}
