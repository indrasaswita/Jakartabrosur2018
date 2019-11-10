<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class AdmCustomerAJAX extends Controller
{
	public function saveusernopass(Request $request){

		$data = $request->all();
		

		$customer = new Customer();

		if($customer == null)
			return null;

		$customer->email = $data['email'];
		$customer->password = '';
		$customer->name = $data['name'];
		$customer->phone1 = $data["phone1"];
		$customer->phone2 = $data["phone2"];
		$customer->phone3 = $data["phone3"];
		$customer->title = $data['title'];
		$customer->type = $data['type'];
		$customer->news = 0;
		$customer->balance = 0;
		if($data['type'] != 'personal')
			$customer->companyID = $data['companyID'];
		else
			$customer->companyID = 1;

		$result = $customer->save();

		return $result."";
	}

	public function updateusernopass(Request $request){

		$data = $request->all();


		$customer = Customer::where('email', $data['email'])
			->first();

		if($customer == null)
			return null;

		$customer->name = $data['name'];
		$customer->phone1 = $data["phone1"];
		$customer->phone2 = $data["phone2"];
		$customer->phone3 = $data["phone3"];
		$customer->title = $data['title'];
		$customer->type = $data['type'];
		if($data['type'] != 'personal')
			$customer->companyID = $data['companyID'];
		else
			$customer->companyID = 1;

		$result = $customer->save();

		return $result."";
	}
}
