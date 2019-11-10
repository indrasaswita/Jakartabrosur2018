<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companybankacc;

class CompanybankaccAJAX extends Controller
{
	public function getAll(){
		$companybankaccs = Companybankacc::with('bank')
				->get();
		return $companybankaccs;
	}
}
