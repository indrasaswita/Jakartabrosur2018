<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paper;
use DB;

class PaperAPI extends Controller
{
	public function getAll(){
		$papers = Paper::with('papertype', 'paperdetail', 'coatingtype')
				->get();
		return $papers;
	}

	public function showFlyer(){
		$papers = Paper::with('papertype')
				->whereIn('papertypeID', 
					DB::table('papertypes')
						->where('category', '0')
						->pluck('id')
				)
				->get();

		return $papers;
	}
}
