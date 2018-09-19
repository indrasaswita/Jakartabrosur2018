<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = ['papertypeID', 'name', 'color', 'gramature', 'texture', 'numerator', 'varnish', 'spotuv', 'laminating', 'folding', 'perforation'];

    protected $hidden = ['created_at', 'updated_at', 'texture', 'numerator', 'varnish', 'spotuv', 'laminating', 'folding', 'perforation'];


    public function papertype(){
    	return $this->belongsTo('App\Papertype', 'papertypeID')->select('id', 'name', 'category');
    }

    public function paperdetail(){
    	return $this->hasMany("App\Paperdetail", 'paperID')->with('vendor', 'plano');
    }
}
