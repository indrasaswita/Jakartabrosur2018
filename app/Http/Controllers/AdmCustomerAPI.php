<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class AdmCustomerAPI extends Controller
{
	public function getAll(){
		$datas = Customer::with('company')
				->with('salesheader')
				->orderBy('created_at', 'desc')
				->get();

		return $datas;
	}
	
}
