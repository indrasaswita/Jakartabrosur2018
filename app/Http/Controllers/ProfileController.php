<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests;

class ProfileController extends Controller
{
	public function index()
	{
		$customerID = session()->get('userid');
		$customer = Customer::with('company', 'customeraddress')
				->where('id', '=', $customerID)
				->first();
							
		return view('pages.account.profile', compact('customer'));
	}

	public function changepass()
	{
		$customerID = session()->get('userid');
		$customer = Customer::findOrFail($customerID);
		return view('pages.account.chpass', compact('customer'));
	}
}
