<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printingdigitalprice extends Model
{
    protected $fillable = ['machineID', 'minqty', 'unitprice'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function machine(){
    	return $this->belongsTo('App\PrintingMachine', 'machineID');
    }
}
