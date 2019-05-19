<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companybankaccmutation extends Model
{
	protected $fillable = ['id', 'accountID', 'mutationDate', 'mutationNote', 'mutationAmmount', 'checked', 'created_at', 'updated_at'];
	protected $casts = ['checked'];
	protected $dates = ['mutationDate', 'created_at', 'updated_at'];
	protected $guarded = ['id'];

	public function companybankacc(){
		return $this->belongsTo('App\Companybankacc', 'accountID')->with('bank');
	}
}
