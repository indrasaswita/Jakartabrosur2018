<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtypequantity;

class AdmJobsubtypequantityAJAX extends Controller
{

	public function changeofdg($id){
		$jobsubtypepaperID = $id;

		$hasil = Jobsubtypequantity::find($id);
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
	public function changequantity(Request $request, $id){
		$jobsubtypepaperID = $id;
		$quantity = $request->all()['quantity'];

		$hasil = Jobsubtypequantity::find($id);
		if($hasil == null){
			return null;
		}else{
			$hasil->quantity = $quantity;
			$hasil->save();
			return "success";
		}
	}

	public function addnewjobquantity(Request $request){
		$dt = $request->all();


		$before = Jobsubtypequantity::orderBy('id', 'desc')->first();

		if($before==null){
			return "error";
		}

		$newjob = new Jobsubtypequantity();
		$newjob->jobsubtypeID = $dt['jobsubtypeID'];
		$newjob->ofdg = $dt['ofdg'];
		$newjob->quantity = $dt['quantity'];
		$newjob->save();

		$last = Jobsubtypequantity::orderBy("id", 'desc')->first();
		if($last != null){
			if($last['id'] != $before['id']){
				return $last['id'];
			}
		}
		return "error";
	}

	public function deletejobsubtypequantity($id){
		//$JobsubtypequantityID = $id;
		$del = Jobsubtypequantity::findOrFail($id);
		$del->delete();

		$find = Jobsubtypequantity::find($id);
		if($find == null)
			return "success";
		else
			return "not deleted - error";
	}
}
