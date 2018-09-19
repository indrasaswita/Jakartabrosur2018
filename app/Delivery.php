<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
		protected $fillable=['deliverytype', 'deliveryname', 'baseprice', 'price', 'priceper', 'dayservice', 'note', 'locked'];
		protected $hidden = ['created_at', 'updated_at'];

		public function salesdelivery(){
			return $this->hasMany("App\Salesdelivery", 'deliveryID');
		}
}
