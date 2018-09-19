<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobsubtypequantity extends Model
{
    protected $fillable = ['jobsubtypeID', 'ofdg', 'quantity'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
}
