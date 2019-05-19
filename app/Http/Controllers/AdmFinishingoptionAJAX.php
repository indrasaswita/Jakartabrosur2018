<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Finishingoption;

class AdmFinishingoptionAJAX extends Controller
{
	public function updatepriceminim(Request $request){
		$data = $request->all();
		$id = $data['id'];
		$priceminim = $data['priceminim'];

		$hasil = Finishingoption::find($id);
		if($hasil!=null){
			$oldpriceminim = $hasil['priceminim'];

			if($oldpriceminim == $priceminim){
				//sesuai
				return "no changes";
			}else{
				$hasil->priceminim = $priceminim;
				$hasil->save();
				return "success";
			}
		}else{
			return "not found";
		}
	}

	public function updateprice(Request $request){
		$data = $request->all();
		$id = $data['id'];
		$price = $data['price'];

		$hasil = Finishingoption::find($id);
		if($hasil!=null){
			$oldprice = $hasil['price'];

			if($oldprice == $price){
				//sesuai
				return "no changes";
			}else{
				$hasil->price = $price;
				$hasil->save();
				return "success";
			}
		}else{
			return "not found";
		}
	}

	public function updatepricebase(Request $request){
		$data = $request->all();
		$id = $data['id'];
		$pricebase = $data['pricebase'];

		$hasil = Finishingoption::find($id);
		if($hasil!=null){
			$oldpricebase = $hasil['pricebase'];

			if($oldpricebase == $pricebase){
				//sesuai
				return "no changes";
			}else{
				$hasil->pricebase = $pricebase;
				$hasil->save();
				return "success";
			}
		}else{
			return "not found";
		}
	}
}
