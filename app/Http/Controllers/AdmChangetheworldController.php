<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Jobsubtype;

class AdmChangetheworldController extends Controller
{
	public function index(){
		$datas = DB::select('SHOW TABLES');
		$datas = json_encode(array_map('current',$datas));

		// $datas = Jobsubtype::all();

		//return $datas;
		return view('pages.admin.changetheworld.index')->with('datas', $datas);
	}
}
