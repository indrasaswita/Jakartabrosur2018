<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;

class VendorAPI extends Controller
{
	public function papershop(){
		$datas = Vendor::where('salestype', '=', 'paper')
				->get();
		return $datas;
	}

	public function allshop(){
		$datas = Vendor::all();
		return $datas;
	}
}
