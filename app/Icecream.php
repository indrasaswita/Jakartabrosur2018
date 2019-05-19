<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icecream extends Model
{
    protected $fillable = ['name', 'sellprice', 'buyprice', 'perpak', 'stock', 'minstock', 'barcode', 'image'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
}
