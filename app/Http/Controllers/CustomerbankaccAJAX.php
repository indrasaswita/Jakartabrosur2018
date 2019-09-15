<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customerbankacc;

class CustomerbankaccAJAX extends Controller
{
	public function insert(Request $request){
		$data = $request->all();
		$userid = session()->get('userid');
		if($userid == null) return "Unauthorized action";

		if($data != null){
			$data['accno'] = $data['accno'] == null ? "" : $data['accno'];
			$data['accname'] = $data['accname'] == null ? "" : $data['accname'];
			$cek = Customerbankacc::where('bankID', $data['bank']['id'])
					->where('accno', $data['accno'])
					->where('accname', $data['accname'])
					->where('customerID', $userid)
					->first();

			if ($cek != null) {
				//sudah ada sebelomnya, duplicated
			} else {
				$nw = new Customerbankacc();

				$nw->customerID = $userid;
				$nw->bankID = $data['bank']['id'];
				$nw->accname = $data['accname'];
				$nw->accno = $data['accno'];
				$nw->acclocation = ""; // belom dipake
				$nw->save();


				$cek = Customerbankacc::where('bankID', $data['bank']['id'])
						->where('accno', $data['accno'])
						->where('accname', $data['accname'])
						->where('customerID', $userid)
						->first();
				//cek di isi	
			}

			if($cek != null){
				//kesave
				$custbankaccs = Customerbankacc::where('customerID', $userid)
						->with('bank')
						->with('customer')
						->orderBy('id', 'desc')
						->get(); 
				return array($cek['id'], $custbankaccs);
			}else{
				return "Cannot be saved";
			}
		}else{
			return "Wrong request input";
		}
	}

	public function update(Request $request){
		$data = $request->all();

		if($data == null){
			return null;
		}else{
			//kalo ada datanya di update
		}
	}
}
