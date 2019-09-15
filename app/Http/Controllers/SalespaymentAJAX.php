<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salespayment;
use App\Http\Controllers\SalesheaderAJAX;
use Carbon\Carbon;

class SalespaymentAJAX extends Controller
{
	public function insert(Request $request){
		$data = $request->all();

		$nw = new Salespayment();
		$nw->salesID = $data['salesID'];
		$nw->customeraccID = $data['custacc']['id'];
		$nw->companyaccID = $data['compacc']['id'];
		$nw->paydate = Carbon::now();
		$nw->note = "by cust";
		$nw->ammount = $data['paymentammount'];
		$nw->type = "TRANSFER";
		$result = $nw->save();

		if($result == true){
			return $this->getBySalesID($data['salesID']);
		}
		else{
			return null;
		}
	}

	public function getBySalesID($salesid){
		$data = Salespayment::with("customeracc")
				->with('companyacc')
				->with('salespaymentverif')
				->where('salesID', $salesid)
				->get();

		return $data;
	}
}
