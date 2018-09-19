<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customerbankacc extends Model
{
    protected $fillable = ['customerID', 'bankID', 'accno', 'accname', 'acclocation'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function bank(){
    	return $this->belongsTo('App\Bank', 'bankID');
    }
}
