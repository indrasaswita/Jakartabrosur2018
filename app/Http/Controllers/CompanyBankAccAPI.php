<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companybankacc;
use App\Http\Requests;

class CompanyBankAccAPI extends Controller
{
	public function getAll(){
		$companybankaccs = Companybankacc::with('bank')
				->get();
		return $companybankaccs;
	}
}
