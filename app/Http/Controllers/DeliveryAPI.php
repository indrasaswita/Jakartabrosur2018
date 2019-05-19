<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\MathHelper;
use App\Delivery;

class DeliveryAPI extends Controller
{
	public function getAll(){
		$deliveries = Delivery::all();

		return $deliveries;
	}

	public function getHarga(Request $request){
		$data = $request->all()['data'];
		$berat = $request->all()['berat'];

		$baseprice = $data['baseprice'];
		//echo $price."<br>";

		$tambahan = 0;

		if($data['priceper'] == "kg")
		{
			//HARGA DI HITUNG PERKG
			$tambahan = $data['price'] * intval(MathHelper::ceil($berat, 1));
		}
		//echo $data['price'];
		$harga = intval($baseprice) + intval($tambahan);

		return $harga;
	}
}
