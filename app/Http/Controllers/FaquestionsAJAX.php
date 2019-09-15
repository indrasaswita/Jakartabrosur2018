<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questiontype;
use App\Faquestion;
use DB;

class FaquestionsAJAX extends Controller
{
	public function getByGroup(){
		$faquestions = Faquestion::with('questiontype')
			/*->whereHas('faquestion',function($query){
				$query->where('favourite', 1);})*/
			->get();

		return $faquestions;
	}
}

// ['faquestion'=>function(){
// 					$query->orderBy('favourite')->get();	
// 				}]