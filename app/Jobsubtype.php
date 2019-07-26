<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtype extends Model
{
	protected $fillable=['jobtypeID', 'name', 'printtype', 'subname', 'description', 'link', 'digitaloffset', 'minoffset', 'maxoffset', 'stepoffset', 'defaultoffset', 'mindigital', 'maxdigital', 'stepdigital', 'defaultdigital', 'satuan', 'infoqty', 'infosize', 'infomaterial', 'infosisicetak', 'infoproses', 'infodelivery', 'infoperbungkus', 'inforeseller', 'infosponsor', 'qtyoffsettype', 'qtydigitaltype', 'sizetype', 'sisicetak', 'warnacetak', 'stdoffset', 'expoffset', 'stddigital', 'expdigital', 'numerator', 'idcard', 'rangkap', 'active', 'icon', 'sicon1', 'sicon2', 'printerIDoffset', 'printerIDdigital', 'shortlabel', 'discount'];

	protected $guarded = ['id'];
	protected $hidden =	['created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at']; 

	public function printeroffset(){
		return $this->belongsTo('App\Printingmachine', 'printerIDoffset');
	}

	public function printerdigital(){
		return $this->belongsTo('App\Printingmachine', 'printerIDdigital');
	}

	public function jobsubtypesize(){
		return $this->hasMany('App\Jobsubtypesize', 'jobsubtypeID')->with('size');
	}

	public function jobsubtypedetail(){
		return $this->hasMany('App\Jobsubtypedetail', 'jobsubtypeID')->with('jobsubtypedetailfinishing', 'jobsubtypedetailpaper');
	}

	public function jobsubtypequantity(){
		return $this->hasMany('App\Jobsubtypequantity', 'jobsubtypeID');
	}

	public function jobsubtypepaper(){
		return $this->hasMany('App\Jobsubtypepaper', 'jobsubtypeID')->with('paper');
	}

	public function jobsubtypefinishing(){
		return $this->hasMany('App\Jobsubtypefinishing', 'jobsubtypeID')->with('finishing');
	}

	public function jobtype(){
		return $this->belongsTo('App\Jobtype', 'jobtypeID');
	}

	public function jobsubtypetemplate(){
		return $this->hasMany('App\Jobsubtypetemplate', 'jobsubtypeID')->with('jobsubtypetemplatefinishing', 'size', 'paper');
	}
}
