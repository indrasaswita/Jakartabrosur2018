<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{
	protected $fillable = ['name', 'loc', 'chfreq', 'prio'];
	protected $guarded = ['id'];
	protected $dates = ['created_at', 'updated_at'];
}
