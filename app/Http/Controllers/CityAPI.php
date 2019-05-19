<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityAPI extends Controller
{
	public function getAll(){
		$cities = City::with('address')
				->get();
		return $cities;
	}
}
