<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtypepaper;
use DB;

class AdmJobsubtypepaperAJAX extends Controller
{
	public function store(Request $request){
		$datas = $request->all();

		if($datas != null){
			if(count($datas)==0){
				return "input is empty";
			}else{
				DB::table('jobsubtypepapers')
					->insert($datas);

				return "success";
			}
		}else{
			return "no input";
		}
	}

	public function delete(Request $request){
		$datas = $request->all();

		if($datas == null){
			return "no input";
		}else{
			if(count($datas)==0){
				return "input empty";
			}else{
				$hasil = Jobsubtypepaper::where("paperID", $datas['paperID'])
					->where("jobsubtypeID", $datas['jobsubtypeID'])
					->where("ofdg", $datas['ofdg'])
					->first();

				if($hasil == null){
					return "not found";
				}else{
					$hasil->delete();
					return "success";
				}
			}
		}
	}
}
