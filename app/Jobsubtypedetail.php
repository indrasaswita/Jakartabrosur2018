<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypedetail extends Model
{
    protected $fillable = ['jobsubtypeID', 'detailname', 'sizetype', 'detailquantity', 'sisicetak', 'defaultmultip', 'stepmultip', 'minmultip', 'maxmultip'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = ['id'];

    public function jobsubtype(){
    	return $this->belongsTo('App\Jobsubtype', 'jobsubtypeID');
    }

    public function jobsubtypedetailfinishing(){
    	return $this->hasMany('App\Jobsubtypedetailfinishing', 'jobsubtypedetailID')->with('finishing');
    }
    public function jobsubtypedetailfinishingshop(){
        return $this->hasMany('App\Jobsubtypedetailfinishing', 'jobsubtypedetailID')->with('finishingshop');
    }

    public function jobsubtypedetailpaper(){
    	return $this->hasMany('App\Jobsubtypedetailpaper', 'jobsubtypedetailID')->with('paper');
    }

    public function jobsubtypedetailpapershop(){
        return $this->hasMany('App\Jobsubtypedetailpaper', 'jobsubtypedetailID')->with('papershop');
    }
}
