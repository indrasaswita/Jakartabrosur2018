<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companybankacc;
use App\Http\Requests;

class CompanyBankAccAPI extends Controller
{
	public function getAll(){
		$companybankaccs = Companybankacc::join('banks', 'banks.id', '=', 'bankID')
				->select('banks.*', 'companybankaccs.*')
				->get();
		return $companybankaccs;
	}
}
