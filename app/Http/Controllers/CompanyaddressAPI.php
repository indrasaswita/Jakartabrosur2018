<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companyaddress;
use App\Address;
use App\Customer;

class CompanyaddressAPI extends Controller
{
	public function bycompid($compid){
		$addresses = Companyaddress::with('company', 'address')
			->where('companyID', $compid)
			->orderBy('id', 'asc')
			->get();

	return $addresses;		
	}

	public function store(Request $request, $custID){
		$customer = Customer::findOrFail($custID);
		$datas = $request->all();

		if($datas != null){
			$add = new Address();
			$add->name = $datas['name'];
			$add->address = $datas['address'];
			$add->addressnotes = $datas['addressnotes'];
			$add->cityID = $datas['city']['id'];
			$add->save();

			$lastadd = Address::orderBy('id', 'DESC')
					-> first();
			if($lastadd != null){
				$compaddr = new Companyaddress();
				$compaddr->companyID = $customer['companyID'];
				$compaddr->addressID = $lastadd['id'];
				$compaddr->save();

				$addresses = $this->bycompid($customer['companyID']);
				return $addresses;
			}else{
				return null;
			}
		}
		else{
				return null;
			}
	}
}
