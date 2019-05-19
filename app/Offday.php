<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offday extends Model
{
    protected $fillable = ['employeeID', 'offday', 'starttime', 'endtime', 'description', 'status'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
}
