<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Papersize;

class PaperSizeAPI extends Controller
{
	public function all(){
		$sizes = Papersize::all();
		return $sizes;
	}
}
