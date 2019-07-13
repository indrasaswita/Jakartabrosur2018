<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtypefinishing;

class AdmJobsubtypefinishingAJAX extends Controller
{
	public function changemustdo($id){
		$jobsubtypepaperID = $id;

		$hasil = Jobsubtypefinishing::find($id);
		if($hasil == null){
			return null;
		}else{
			$mustdo = $hasil->mustdo;
			if($mustdo==0){
				$mustdo = 1;
			}else{
				$mustdo = 0;
			}
			$hasil->mustdo = $mustdo;
			$hasil->save();
			return $mustdo;
		}
	}

	public function store(Request $request)
	{
		$datas = $request->all();

		if($datas!=null)
		{
			$add = new Jobsubtypefinishing();
			$add->jobsubtypeID = $datas['jobsubtypeID'];
			$add->ofdg = $datas['ofdg'] == true ? 1 : 0;
			$add->finishingID = $datas['finishingID']['id'];
			$add->mustdo = $datas['mustdo'] == true ? 1 : 0;
			$add->save();

			$lastadd = Jobsubtypefinishing::orderBy('id', 'DESC')
				->first();
			if($lastadd != null)
			{
				return $lastadd;
			}
			else
			{
				return null;
			}
		}
		else
		{
			return null;
		}
	}
}
