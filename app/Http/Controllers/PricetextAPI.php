<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pricetext;

class PricetextAPI extends Controller
{
	public function insert(Request $request){
		$data = $request->all();

		$last = Pricetext::latest()->first()['id'];

		$pricetext = new Pricetext();
		$pricetext->jobsubtypeID = $data['jobsubtypeID'];
		$pricetext->customerID = $data['customerID'];
		$pricetext->employeeID = $data['employeeID'];
		$pricetext->pricetext = $data['pricetext'];
		$pricetext->totalprice = $data['totalprice'];
		$pricetext->save();

		$new = Pricetext::latest()->first()['id'];

		if($last == $new){
			return "failed to save";
		}else{
			return "success";
		}
	}
}
