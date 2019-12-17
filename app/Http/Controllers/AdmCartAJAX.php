<?php

namespace App\Http\Controllers;

use App\Salesheader;
use App\Salesdetail;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdmCartAJAX extends Controller
{
	public function checkout(Request $request){
		$data = $request->all();
		if(count($data)==0)
			return null;

		if(!array_key_exists('customerID', $data[0]))
			return null;

		$header = new Salesheader();
		$customerID = $data[0]['customerID'];
		$header->customerID = $customerID;
		$header->tempo = Carbon::now();
		$header->estdate = Carbon::now();

		$customer = Customer::where('id', $customerID)
		        ->with('company')
		        ->first();
		//kalo customernya ga ketemu = hack
		if($customer!=null){
   if($customer['company']['id']!=null){
    $header->companyname = $customer['company']['name'];
   }else{
    $header->companyname = '';
   }
   $result = $header->save();

   if($result){
				$headerID = Salesheader::latest()
					->limit(1)
					->select('id')
					->get()[0]['id'];
				for($i=0;$i<count($data);$i++)
				{
					$detail = new Salesdetail();
					$detail->salesID = $headerID;
					$detail->cartID = $data[$i]['id'];
					$detail->prioritylevel = 2;
					$detail->statusfile = 1;
					$detail->statusctp = 0;
					$detail->statusprint = 0;
					$detail->statuspacking = 0;
					$detail->statusdelivery = 0;
					$detail->statusdone = 0;
					$detail->save();
				}
				return $headerID;
   }
		}


		return null;
	}
}
