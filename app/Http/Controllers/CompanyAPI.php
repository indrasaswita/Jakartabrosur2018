<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyAPI extends Controller
{
	public function getAll()
	{
		$companies = Company::all();
		return $companies;
	}

	public function getPending()
	{
		$companies = Company::where('verified', '=', '0')
				->where('id', '<>', '1')
				->get();
		return $companies;
	}
}
