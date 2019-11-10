<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Company;

class AdmCustomerController extends Controller
{
	public function pendingOnly()
	{
		$customers = Customer::where('verify_token', '!=', null)
				->orderBy('updated_at', 'desc')
				->get();
		return view('pages.admin.master.customer.pendingcustomer', compact('customers'));
	}

	public function addusernopass(){
		$customers = Customer::with('company')
				->with('customeraddress')
				->get();

		$companies = Company::all();

		return view('pages.admin.master.customer.addusernopass', compact('companies', 'customers'));
	}
}
