<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;

class FileAPI extends Controller
{
	public function getFileUnbinded(){
		$userID = session()->get('userid');
		$files = null;
		if($userID != null)
			$files = Files::where('customerID', '=', $userID)
					->doesnthave('cartfile')
					->get();

		return $files;
	}
}
