<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerAJAX extends Controller
{

	public function verifywithcode(Request $request){
		$data = $request->all();

		if(isset($data['code']))
			$code = $data['code'];
		else
			$code = null;

		if($code == null)
			return "ERROR: tidak ada data.";
		else{

			if(session()->get('userid')==null)
				return "Tidak bisa verifikasi sebelum Anda masuk ke akun.";
			else{
				$customer = Customer::where('id', session()->get('userid'))
						->first();

				if($customer['verify_token']==null)
					return "Akun sudah di verifikasi";
				else{
					$code_server = substr($customer['verify_token'], 6, 4);
					if($code == $code_server){

						$customer['verify_token'] = null;
						$customer->save();

						return "success";
					}else{
						return "wrong ID";
					}
				}
			}
		}

	}
}
