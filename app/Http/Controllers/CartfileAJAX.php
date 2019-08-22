<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;

class CartfileAJAX extends Controller
{
	public function savefile(Request $request){

		$datas = $request->all();
		$file = Files::findOrFail($datas['id']);
		$file->fill($datas);
		$file->detail = $file->detail==null?"":$file->detail;
		$saved = $file->save();

		if($saved){
			return array("code"=>200, "message"=>"success");
		} else {
			return array("code"=>500, "Error, failed in saving data..");
		}
	}
}
