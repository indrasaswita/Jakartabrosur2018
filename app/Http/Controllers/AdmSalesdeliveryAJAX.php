<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmSalesdeliveryAJAX extends Controller
{
	//PARAMETER $id => salesID
	public function store(Request $request, $id){
		$salesID = $id;
		$data = $request->all();

		$header = new Salesdelivery();
		$header->salesID = $salesID;
		$header->employeeID =  array_key_exists('employeeID', $data)?$data['employeeID']:null;
		$header->receiver = $data['receiver'];
		$header->addressID = array_key_exists('deliveryaddressID', $data)?$data['deliveryaddressID']:null;
		$header->deliveryID = $data['deliveryID'];
		$header->suratno = $data['suratno'];
		$header->suratimage = $data['suratimage'];
		$header->employeenote = $data['employeenote'];
		$header->arrivedtime = $data['delivtime'];

		$header->save();

		$header = Salesdelivery::orderBy('id', 'desc')
					->select('id')
					->first();

		foreach ($data['deliverydetail'] as $i => $ii) {
			$detail = new Salesdeliverydetail();
			$detail->salesdetailID = $ii['salesdetailID'];
			$detail->salesdeliveryID = $header['id'];
			$detail->actualprice = $ii['actualprice'];
			$detail->quantity = $ii['ammount'];
			$detail->weight = $ii['totalweight'];
			$detail->totalpackage = $ii['totalpackage'];
			//STATUS 0 -> baru di buat, belom di print
			$detail->status = 0;

			$detail->save();
		}
		
		return "success";
	}

	public function update(Request $request){
		$data = $request->all();

		$header = Salesdelivery::findOrFail($data['id']);
		$header->employeeID = $data['employeeID'];
		$header->receiver = $data['receiver'];
		$header->addressID = $data['addressID'];
		$header->deliveryID = $data['deliveryID'];
		$header->suratno = $data['suratno'];
		$header->suratimage = $data['suratimage'];
		$header->employeenote = $data['employeenote'];
		$header->arrivedtime = $data['delivtime'];

		$header->save();

		foreach ($data['salesdeliverydetail'] as $i => $ii) {
			$detail = Salesdeliverydetail::findOrFail($ii['id']);
			$detail->actualprice = $ii['actualprice'];
			$detail->quantity = $ii['quantity'];
			$detail->weight = $ii['weight'];
			$detail->totalpackage = $ii['totalpackage'];
			$detail->status = $ii['status'];

			$detail->save();
		}
		
		return "success";
	}
}
