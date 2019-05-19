<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmCompanyController extends Controller
{
	public function pendingOnly(){
		$companies = Company::where('verified', '=', '0')
				->where('id', '<>', 1)
				->with('customer', 'city')
				->get();

		return view('pages.admin.master.customer.pendingcompany', compact('companies'));
	}
}
