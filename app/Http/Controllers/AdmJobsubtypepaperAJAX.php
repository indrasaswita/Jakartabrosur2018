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

	public function changefavourite($id){
		$jobsubtypepaperID = $id;

		$hasil = Jobsubtypepaper::find($id);
		if($hasil == null){
			return null;
		}else{
			$fav = $hasil->favourite;
			if($fav==0){
				$fav = 1;
			}else{
				$fav = 0;
			}
			$hasil->favourite = $fav;
			$hasil->save();
			return $fav;
		}
	}

	public function changeofdg($id){
		$jobsubtypepaperID = $id;

		$hasil = Jobsubtypepaper::find($id);
		if($hasil == null){
			return null;
		}else{
			$ofdg = $hasil->ofdg;
			if($ofdg==2){
				$ofdg = 1;
			}else{
				$ofdg = 2;
			}
			$hasil->ofdg = $ofdg;
			$hasil->save();
			return $ofdg;
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
