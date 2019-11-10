<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Customer;
use App\Employee;
use App\Http\Requests;

class UserController extends Controller
{
	public function loginpage(Request $request){
		$data = $request->all();

		//return $data;
		$url = "";
		if($data!=null)
			if(array_keys($data)[0] == "url"){
				$url = "";
				$ix = 0;
				foreach ($data as $i => $ii) {
					if ($ix == 0)
						$url .= $ii;
					else
						$url .= "&".$i."=".$ii;
					$ix++;
				}
			}
		//dd(session()->all());
		return view('pages.account.loginpage', compact('url'));
	}
	public function signuppage(){
		return view('pages.account.signuppage');
	}

	public function resendemail(){
		return view('includes.konfirmasiemail');
	}
}
