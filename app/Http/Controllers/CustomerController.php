<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Customer;
use App\Http\Requests;
use App\Http\Requests\CustomerRequest;
use Hash;

class CustomerController extends Controller
{
	
	public function index()
	{
		$customers = Customer::with('company', 'salesheader', 'city', 'customerbankacc')
				->orderBy('name', 'asc')
				->get();
		/*$role = Cache::get('role');
		$fullname = Cache::get('name');
		$email = Cache::get('email');*/
		$customers->makeVisible(['balance']);
		return view('pages.admin.master.customer.index', compact('customers'));
	}
	public function store(CustomerRequest $request)
	{
		//CustomerModel::create(Request::all());
		$data = $request->all();
		$data['password'] = Hash::make($data['password']);

		$hasil = Customer::where('email', '=', $data['email'])
							->first();
		if($hasil != null){
			$result = array("message"=>"Anda sudah pernah daftar! Jika lupa password, silahkan ke bagian 'forgot password.'", "type"=>"alert-danger");
			return $result;
		}

		Customer::create($data);

		$msg = "Berhasil! Silahkan Log-in.";
		$type = "alert-success";
		$result = array("message"=>$msg, "type"=>$type);
		//echo json_encode($result);
		return $result;
	}
}
