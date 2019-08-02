<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Papertype;

class PapertypeAPI extends Controller
{
	public function getAll(){
		$data = Papertype::all();
		return $data;
	}
}
