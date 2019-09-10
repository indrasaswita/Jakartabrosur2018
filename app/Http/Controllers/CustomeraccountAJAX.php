<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customerbankacc;

class CustomeraccountAJAX extends Controller
{
	public function all(){
		$custid = session()->get('userid');
		$accs = Customerbankacc::with('bank')
				->with('customer')
				->where('customerID', '=', $custid)
				->get();
		return $accs;
	}

	//MASUKIN DATA BANK YG BARU
	public function store(Request $request){
		$custid = session()->get('userid');
		$data = $request->all();
		$bankID = $data['bankID'];
		$no = $data['accno'];
		$nm = $data['accname'];
		$loc = $data['acclocation'];

		$acc = new Customerbankacc();
		$acc->customerID = $custid;
		$acc->bankID = $bankID;
		$acc->accno = $no;
		$acc->accname = $nm;
		$acc->acclocation = $loc;
		$acc->save();

		$test = Customerbankacc::orderBy('id', 'DESC')
				->first();
		if($test!=null)
		{
			if($test['accno'] == $no){
				$accs = $this->all();
				return $accs;
			}
		}
		return null;
	}

}
