<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Onesignal;

class OnesignalAJAX extends Controller
{
	public function getAll(){
		$datas = Onesignal::with('customeronesignal')
				->with('employeeonesignal')
				->get();

		return $datas;
	}

	public function getAllActive(){
		$datas = Onesignal::with('customeronesignal')
				->with('employeeonesignal')
				->where('active', 1)
				->get();
	}
}
