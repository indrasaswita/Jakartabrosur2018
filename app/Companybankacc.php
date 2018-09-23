<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companybankacc extends Model
{
	protected $fillable = ['bankID', 'accname', 'accno', 'acclocation'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function bank(){
		return $this->belongsTo('App\Bank', 'bankID');
	}
}
