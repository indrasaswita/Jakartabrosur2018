<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customerbankacc;

class CustomeraccountAJAX extends Controller
{
	public function all(){

		$custid = session()->get('userid');
		$accs = $this->getalldata($custid);
		return $accs;
	}

	public function getalldata($custid){
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
		if(isset($data['custID']))
			$custid = $data['custID']==null?$custid:$data['custID'];
		//kalo bukan customer harus ada index custID

		$acc = new Customerbankacc();
		$acc->customerID = $custid;
		$acc->bankID = $bankID;
		$acc->accno = $no==null?"":$no;
		$acc->accname = $nm;
		$acc->acclocation = $loc==null?"":$loc;
		$result = $acc->save();

		if($result){
			$accs = $this->getalldata($custid);
			return $accs;
		}else{
			return null;
		}
	}

}
