<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Customer;
use App\Employee;
use Hash;
use DB;
use Carbon\Carbon;

class ProfileAJAX extends Controller
{
	public function updateAll(ProfileUpdateRequest $request, $id)
	{
		if(!session()->has('userid'))
			return "LOG-IN NEEDED";
		$customerID = session()->get('userid');
		$data = $request->all();
		$email = $data['email'];
		$phone1 = $data['phone1'];
		$phone2 = $data['phone2'];
		$phone3 = $data['phone3'];
		$type = $data['type'];
		$name = $data['name'];
		// $verified = $data['verified'];
		$companyID = $data['companyID'];
		$title = $data['title'];
		$news = $data['news'];

		if($customerID != $id)
			return ["status"=>"error", 'data'=>"login-error"];
		else
		{
			DB::table('customers')->where('id', '=', $id)
				->update([
						'name' => $name,
						'email' => $email,
						'phone1' => $phone1,
						'phone2' => $phone2,
						'phone3' => $phone3,
						'type' => $type,
						'title' => $title,
						'news' => $news
				]);
			return ['status'=>'success', 'data'=>$this->ajaxGetAll()];
		}
	}
	public function updatePassword(Request $request, $id)
	{
		if(!session()->has('userid'))
			return "LOG-IN NEEDED";
		else if(!session()->has('role'))
			return "LOG-IN NEEDED";

		$role = session()->get('role');

		$data = $request->all();
		$old = $data['password'];
		$new = $data['newpass'];
		$user = null;
		if($role == 'Administrator'){
			$user = Employee::findOrFail($id);
		}else{
			$user = Customer::findOrFail($id);
		}
		if($user != null){
			if(Hash::check($old, $user['password']))
			{
				if($role != 'Administrator'){
					DB::table('customers')->where('id', '=', $id)
							->update(['password'=> Hash::make($new)]);
				}else{
					DB::table('employees')->where('id', '=', $id)
							->update(['password'=> Hash::make($new)]);
				}
				return ['status'=>'success'];
			}
			else
			{
				return ['status'=>'error', 'data'=>'Wrong Old Password'];
			}
		}else{
			['status'=>'error', 'data'=>'Data tidak ditemukan, belum ada account yg masuk.'];
		}
	}
	public function ajaxGetAll()
	{
		$customerID = session()->get('userid');
		$customer = Customer::join('companies', 'companies.id', '=', 'companyID')
							->where('customers.id', '=', $customerID)
							->select('companies.*', 'customers.*')
							->first();
		return $customer;
	}
}
