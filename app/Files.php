<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Files extends Model
{
    //use SoftDeletes;
    protected $fillable = ['customerID', 'jobsubtypeID', 'filename', 'size', 'detail', 'revision', 'preview', 'path', 'icon'];
    protected $guarded = ['id'];
    protected $table = "files";
    protected $dates = ['created_at', 'updated_at'];

    public function customer(){
    	return $this->belongsTo("App\Customer", 'customerID')->with('company', 'customeraddress');
    }

    public function cartfile(){
    	return $this->hasOne("App\Cartfile", 'fileID')->with('cartheader');
    }
}
