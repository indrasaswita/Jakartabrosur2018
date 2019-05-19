<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customerbankacc;
use App\Customer;

class CustomeraccountAPI extends Controller
{
	public function getByID($id)
	{
		//$id = customerID
		$acc = Customerbankacc::join('banks', 'banks.id', '=', 'bankID')
				->where('customerID', '=', $id)
				->orderBy('bankID', 'ASC')
				->select('customerbankaccs.id', 'accno', 'accname', 'alias', 'bankname')
				->get();
		return $acc;
	}
}
