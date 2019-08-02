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

	public function changepaperdetail($id, $col){
		$paperID = $id;
		$column = $col;

		$status = Paper::findOrFail($paperID);
		if($status == null){
			return null;
		}else{
			$hasil = $status[$column];

			$hasil ++;
			if($column == 'texture'){
				if($hasil == 4){
					$hasil = 0;
				}
			} // texture max. 3
			else if($column != 'texture'){
				if($hasil == 2){
					$hasil = 0;
				}
			} // selain texture max. 1
			$status[$column] = $hasil;
			$status->save();

			return $hasil;
		}

	}

	public function changepapertypeID(Request $request, $id){
		$paperID = $id;
		$papertypeID = $request->all()[0];

		$status = Paper::findOrFail($paperID);
		if($status == null){
			return null;
		}else{
			$status->papertypeID = $papertypeID;
			$status->save();

			return "success";
		}

	}

	public function addnewpaper(Request $request){
		$datas = $request->all();

		$newpaper = new Paper();
		$newpaper->papertypeID = $datas['papertypeID'];
		$newpaper->name = $datas['name'];
		$newpaper->color = $datas['color'];
		$newpaper->gramature = $datas['gramature'];
		$newpaper->texture = $datas['texture'];
		$newpaper->numerator = $datas['numerator'];
		$newpaper->varnish = $datas['varnish'];
		$newpaper->spotuv = $datas['spotuv'];
		$newpaper->laminating = $datas['laminating'];
		$newpaper->folding = $datas['folding'];
		$newpaper->perforation = $datas['perforation'];
		$newpaper->diecut = $datas['diecut'];
		$newpaper->coatingtypeID = $datas['coatingtypeID'];
		//$newpaper = $datas;
		$newpaper->save();

		$newid = Paper::orderBy('id', 'desc')->first();

		if($newid != null){
			return $newid['id'];
		}else{
			return null;
		}
	}
}
