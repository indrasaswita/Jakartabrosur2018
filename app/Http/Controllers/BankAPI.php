<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Http\Requests;

class BankAPI extends Controller
{
   
	public function getAll(){
		$bank = Bank::orderBy('code', 'asc')
				->where('alias', '<>', '')
				->get();
		$bank2 = Bank::orderBy('code', 'asc')
				->where('alias', '')
				->get();

		return $bank->merge($bank2);
	}
}
