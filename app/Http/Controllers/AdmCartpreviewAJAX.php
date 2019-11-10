<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartpreview;
use DB;
use File;

class AdmCartpreviewAJAX extends Controller
{


	public function undofile($id){
		$item = Cartpreview::findOrFail($id);
		//tidak bisa di lakukan bila sudah accepted ATAU rejected
		if($item->commit==0)
			return null;
		if($item!=null){
			$item->commit = 0;
			$item->save();
			$test = Cartpreview::findOrFail($id);
			if($test->commit==0)
				return "success";
			else
				return "null";
		}else{
			return null;
		}
		return null;
	}

	public function deleteFile($id){
		$cartpreview = Cartpreview::with('file')
				->where('id', $id)
				->first();
		if($cartpreview!=null)
		{
			$path = $cartpreview['file']['path'];
			$icon = $cartpreview['file']['icon'];
			File::delete($path);
			if (strstr($icon, public_path("image/ext-")) != $icon) File::delete($icon);

			$result = $cartpreview->delete();

			return $result."";
		}
		else{
			return null;
		}
	}
}
