<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = ['papertypeID', 'name', 'color', 'gramature', 'printbothside', 'texture', 'numerator', 'varnish', 'spotuv', 'laminating', 'folding', 'perforation', 'diecut', 'coatingtypeID'];

    protected $hidden = ['created_at', 'updated_at', 'texture', 'numerator', 'varnish', 'spotuv', 'laminating', 'folding', 'perforation', 'diecut', 'coatingtypeID'];
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];

    public function papertype(){
    	return $this->belongsTo('App\Papertype', 'papertypeID')->select('id', 'name', 'category');
    }

    public function paperdetail(){
    	return $this->hasMany("App\Paperdetail", 'paperID')->with('vendor', 'plano', 'paper');
    }

    public function coatingtype(){
        return $this->belongsTo("App\Coatingtype", 'coatingtypeID');
    }
}
