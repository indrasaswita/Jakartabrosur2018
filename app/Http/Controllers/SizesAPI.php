<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;

class SizesAPI extends Controller
{
	public function getall(){
		$datas = Size::all();
		return $datas;
	}
}
