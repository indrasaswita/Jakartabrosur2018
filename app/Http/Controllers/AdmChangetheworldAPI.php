<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtype;

class AdmChangetheworldAPI extends Controller
{
	public function jobsubtype(Request $request){
		$datas = $request->all();

		if($datas != null){
			$jobsubtypes = $datas['jobsubtypes'];

			$oldcount = Jobsubtype::all()->count();
			$old = Jobsubtype::truncate();
			DB::table('jobsubtypes')
				->insert($jobsubtypes);
			$newcount = Jobsubtype::all()->count();

			return "You have change ".($newcount-$oldcount)." rows in Jobsubtype table";
		}
	}
}
