<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name', 'shortname', 'width', 'length'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    
}
