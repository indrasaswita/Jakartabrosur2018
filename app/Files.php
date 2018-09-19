<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $fillable = ['customerID', 'jobsubtypeID', 'filename', 'size', 'detail', 'revision', 'preview', 'path', 'icon'];
    protected $guarded = ['id'];
    protected $table = "files";
    protected $dates = ['created_at', 'updated_at'];

    public function customer(){
    	return $this->belongsTo("App\Customer", 'customerID')->with('company', 'city');
    }

    public function cartfile(){
    	return $this->hasOne("App\Cartfile", 'fileID')->with('cartheader');
    }
}
