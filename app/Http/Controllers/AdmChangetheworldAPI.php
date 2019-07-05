<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdmChangetheworldAPI extends Controller
{
	public function database(Request $request, $tablename){
		$datas = $request->all();

		if($datas != null){
			$values = $datas['values'];
			foreach ($values as $key => $value) {
				foreach($value as $key2 => $value2) {
					if($value2 == null && $value2 != 0){
						if($key2 == "created_at" ||
							$key2 == "updated_at" ||
							$key2 == "deleted_at"){
							//kalo time = null aja
						}else{
							$values[$key][$key2] = "";
						}
					}else if($value2 == "" && 
						(
							$key2 == "created_at" ||
							$key2 == "updated_at" ||
							$key2 == "deleted_at"
						) ){
						$values[$key][$key2] = null;
					}else{
						$values[$key][$key2] = str_replace('\'', '\\\'', $value2);
						$values[$key][$key2] = str_replace('\\', '\\\\', $value2);
					}
					//$values[$key][$key2] = "'".$values[$key][$key2]."'";
				}
			}
			//dd($values);

			$oldcount = DB::table($tablename)->count();
			DB::table($tablename)->truncate();
			DB::table($tablename)
				->insert($values);
			$newcount = DB::table($tablename)->count();

			return "You have change ".($newcount-$oldcount)." rows in ".$tablename." table";
		}
	}
}
