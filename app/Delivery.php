<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
		protected $fillable=['deliverytype', 'deliveryname', 'baseprice', 'price', 'priceper', 'dayservice', 'note', 'locked'];
		protected $guarded = ['id'];
		protected $hidden = ['created_at', 'updated_at'];
		protected $dates = ['created_at', 'updated_at'];

		public function salesdelivery(){
			return $this->hasMany("App\Salesdelivery", 'deliveryID');
		}
}
