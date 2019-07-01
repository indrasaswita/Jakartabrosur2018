<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Paperdetail extends Model
{
	protected $fillable = ['paperID', 'vendorID', 'planoID', 'buyprice', 'sellprice', 'unitprice', 'unittype', 'totalpcs', 'available'];

	protected $guarded = ['id'];
	protected $hidden = ['created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at'];

	public function vendor()
	{
		return $this->belongsTo('App\Vendor', 'vendorID')->with('address');
	}

	public function plano()
	{
		return $this->belongsTo('App\Papersize', 'planoID');
	}

	public function paper()
	{
		return $this->belongsTo('App\Paper', 'paperID');
	}
}