<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Salespayment;
use App\Salespaymentverif;
use DB;
use Carbon\Carbon;

class AdmSalesPaymentAJAX extends Controller
{
	public function setPaymentByID($id, Request $request)
	{
		//$id -> salesID
		$data = $request->all();

		$paydate = $data['paydate'];
		$ammount = $data['ammount'];
		$custacc = $data['custacc'];
		$compacc = $data['compacc'];

		$empID = session()->get('userid');

		$payments = Salespayment::where('salesID', '=', $id)
				->select('id')
				->orderBy('id', 'desc')
				->first();

		/*if(count($payments) == 0)
			$newid = 1;
		else
			$newid = $payments['id'] + 1;*/

		$nw = new Salespayment();
		$nw->salesID = $id;
		$nw->customeraccID = $custacc;
		$nw->companyaccID = $compacc;
		$nw->paydate = $paydate;
		$nw->note = "Admin BOT";
		$nw->ammount = $ammount;
		$nw->type = "TRANSFER";
		$result = $nw->save();

		if($result){
			$last = Salespayment::latest('id')->first();
		}else{
			return "failed";
		}

		$nw = new Salespaymentverif();
		//$nw->salesID = $id;
		$nw->paymentID = $last->id;
		$nw->note = "Admin BOT";
		$nw->employeeID = $empID;
		$nw->veriftime = Carbon::now();
		$result = $nw->save();

		if($result){
			return "success";
		}else{
			return "failed";
		}
	}
}
