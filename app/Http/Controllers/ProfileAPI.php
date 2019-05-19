<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests;
use App\Customer;
use DB;
use Hash;
use App\Customeraddress;
use App\Address;
use App\Companyaddress;


class ProfileAPI extends Controller
{
	
	public function apiGetAll()
	{
		$customerID = session()->get('userid');
		$customer = Customer::join('companies', 'companies.id', '=', 'companyID')
							->where('customers.id', '=', $customerID)
							->select('companies.*', 'customers.*')
							->first();
		return $customer;
	}
	public function apiDeleteAddress($id)
	{
		$customeraddress = Customeraddress::findOrFail($id);
		$itemaddress = Address::findOrFail($customeraddress['addressID']);
		$customeraddress->delete();
		$itemaddress->delete();

		$result = Customeraddress::find($id);
		if($result == null){
			return "success";
		}
		return null;
	}
	public function apiDeleteAddressCompany($id)
	{
		$companyaddress = Companyaddress::findOrFail($id);
		$itemaddress = Address::findOrFail($companyaddress['addressID']);
		$companyaddress->delete();
		$itemaddress->delete();

		$result = Companyaddress::find($id);
		if($result == null){
			return "success";
		}
		return null;
	}
	
}
