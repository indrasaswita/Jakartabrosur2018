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
}
