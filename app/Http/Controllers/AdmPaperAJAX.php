<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;

class AdmPaperAJAX extends Controller
{
	public function changecoatingtype(Request $request){
		$datas = $request->all();
		$paper = $datas['paper'];
		$newcoatID = $datas['newcoatid'];


		$hasil = Paper::find($paper['id']);
		if($hasil == null){
			return "not found";
		}
		else{
			if($newcoatID != null){
				if($newcoatID > 0){
					$hasil->coatingtypeID = $newcoatID;
					$hasil->save();

					$akhir = Paper::find($paper['id']);
					if($akhir['coatingtypeID'] == $newcoatID){
						return "success";
					}else{
						return "failed";
					}
				}else{
					return "false input";
				}
			}else{
				return "false input";
			}
		}
	}
}
