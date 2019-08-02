<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
{
	protected $fillable = ['title', 'detail', 'price', 'typeID'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function pricetype(){
		return $this->belongsTo("App\Pricetype", 'typeID');
	}
}
