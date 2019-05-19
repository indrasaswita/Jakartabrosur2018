<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onesignal extends Model
{
	protected $fillable = ['ownertype', 'ownerID', 'player_id', 'active'];
	protected $casts = ['active'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];

	public function customer(){
		return $this->belongsTo('App\Customer', 'ownerID')->with('company');
	} // !!! WARNING !!!
	//WAKTU PAKE HARUS DI KASIH WHERE ownertype = 'CU'

	public function employee(){
		return $this->belongsTo('App\Employee', 'ownerID')->with('role');
	} // !!! WARNING !!!
	//WAKTU PAKE HARUS DI KASIH WHERE ownertype = 'EM'
}
