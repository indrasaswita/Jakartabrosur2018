<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Customer;

class CompanyAJAX extends Controller
{
	public function getAll(){
		$company = Company::with("companyaddress")
				->get();
		return $company;
	}
	public function updateByCompany(Request $request, $id){
		//$id itu adalah companyID
		$customerID = $id;
		$data = $request->all();
		$companyID = $data[0];

		$customer = Customer::findOrFail($customerID);
		if($customer == null){
			return null;
		}else{
			$customer->companyID = $companyID;
			$customer->save();
			return "success";
		}
	}
}
