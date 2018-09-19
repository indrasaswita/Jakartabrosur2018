<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['customerID', 'name', 'address', 'receiver', 'cityID', 'addressnotes'];
}
