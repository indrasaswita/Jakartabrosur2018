<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobtype extends Model
{
    protected $fillable = ['name', 'shortname', 'code'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function jobsubtype(){
    	return $this->hasMany('App\Jobsubtype', 'jobtypeID')->with('jobsubtypesize', 'printeroffset', 'printerdigital', 'jobsubtypedetail', 'jobsubtypequantity', 'jobsubtypepaper', 'jobsubtypefinishing');
    }
}
