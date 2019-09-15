<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdmChangetheworldAJAX extends Controller
{


	public function getByTablename($table){
		$datas = DB::table($table)->get();

		return $datas;
	}
}
