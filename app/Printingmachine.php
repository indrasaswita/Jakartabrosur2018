<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printingmachine extends Model
{
    protected $fillable = ['machinename'];
    protected $guarded = ['id'];
}
