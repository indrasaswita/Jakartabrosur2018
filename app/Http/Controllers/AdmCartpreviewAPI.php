<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Cartpreview;

class AdmCartpreviewAPI extends Controller
{
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

  		$cartpreview->delete();
  	}
  	else{
  		return null;
  	}
  }
}
