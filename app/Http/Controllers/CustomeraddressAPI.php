<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customeraddress;
use App\Address;
use DB;

class CustomeraddressAPI extends Controller
{
	public function all(){
		$addresses = Customeraddress::with('customer', 'address')
				->get();

		return $addresses;
	}

	public function bycustid($custid){
		$addresses = Customeraddress::with('customer', 'address')
				->where('customerID', $custid)
				->orderBy('id', 'asc')
				->get();

		return $addresses;
	}
}
