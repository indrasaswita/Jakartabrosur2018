<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questiontype;

class FaquestionsAJAX extends Controller
{
	public function getByGroup(){
		$questiontypes = Questiontype::with('faquestion')
				->where()
				->get();

		return $questiontypes;
	}
}

// ['faquestion'=>function(){
// 					$query->orderBy('favourite')->get();	
// 				}]