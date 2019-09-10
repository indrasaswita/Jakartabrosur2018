<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Http\Requests;

class BankAPI extends Controller
{
   
	public function getAll(){
		/*$bank = Bank::orderBy('code', 'asc')
				->where('alias', '<>', '')
				->get();
		$bank2 = Bank::orderBy('code', 'asc')
				->where('alias', '')
				->get();
		*/

		$bank = Bank::all();

		//return $bank->merge($bank2);
		return $bank;
	}
}
