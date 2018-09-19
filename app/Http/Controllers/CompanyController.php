<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Company;
use App\Http\Requests;

class CompanyController extends Controller
{
	public function pendingOnly(){
		$companies = Company::where('verified', '=', '0')
				->where('id', '<>', 1)
				->with('customer', 'city')
				->get();

		return view('pages.admin.master.customer.pendingcompany', compact('companies'));
	}
	

	public function verify($id){
		$company = Company::findOrFail($id);
		$company->verified = 1;
		$company->save();
		return redirect()->back();
	}


}
