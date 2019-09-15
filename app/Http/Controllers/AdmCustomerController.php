<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class AdmCustomerController extends Controller
{
	public function pendingOnly()
	{
		$customers = Customer::where('verify_token', '!=', null)
				->orderBy('updated_at', 'desc')
				->get();
		return view('pages.admin.master.customer.pendingcustomer', compact('customers'));
	}
}
