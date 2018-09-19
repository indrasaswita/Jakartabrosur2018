<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests;
use App\Customer;
use DB;
use Hash;

class ProfileAPI extends Controller
{
	public function apiUpdateAll(ProfileUpdateRequest $request, $id)
	{
		$customerID = session()->get('userid');
		$data = $request->all();
		$email = $data['email'];
		$phone1 = $data['phone1'];
		$phone2 = $data['phone2'];
		$phone3 = $data['phone3'];
		$cityID = $data['cityID'];
		$type = $data['type'];
		$verified = $data['verified'];
		$companyID = $data['companyID'];
		$title = $data['title'];
		$postcode = $data['postcode'];
		$news = $data['news'];

		if($customerID != $id)
			return ["status"=>"error", 'data'=>"login-error"];
		else
		{
			DB::table('customers')->where('id', '=', $id)
									->update([


									]);

			return ['status'=>'success', 'data'=>$this->apiGetAll()];
		}
	}
	public function apiUpdatePassword(ProfilePasswordRequest $request, $id)
	{
		$data = $request->all();
		$old = $data['password'];
		$new = $data['newpass'];
		$customer = Customer::findOrFail($id);
		if(Hash::check($old, $customer['password']))
		{
			DB::table('customers')->where('id', '=', $id)
					->update(['password'=> Hash::make($new)]);
			return ['status'=>'success'];
		}
		else
		{
			return ['status'=>'error', 'data'=>'Wrong Old Password'];
		}
	}
	public function apiGetAll()
	{
		$customerID = session()->get('userid');
		$customer = Customer::join('companies', 'companies.id', '=', 'companyID')
							->where('customers.id', '=', $customerID)
							->select('companies.*', 'customers.*')
							->first();
		return $customer;
	}
}
