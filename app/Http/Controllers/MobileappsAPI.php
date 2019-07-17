<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Customer;
use App\Employee;
use App\Onesignal;
use App\Notification;
use App\Cartheader;
use App\Salesheader;
use App\Pricelist;
use App\Pricetype;

class MobileappsAPI extends Controller
{
	public function getcustomers($data, $roleID){
		//$data = $request->all();
		$customers = Customer::orderBy('updated_at', 'desc')
				->orderBy('id', 'desc')
				->get();

		return $customers;
	}

	public function getnotifications($data){
		$notifications = Notification::where('ownerID', $data['userID'])
				->where('owner', $data['usertype'])
				->orderBy('created_at', 'desc')
				->orderBy('id', 'desc')
				->get();

		return $notifications;
	}

	public function updatenotification($data){
		$notification = Notification::where('id', $data['notifID'])
				->where('owner', $data['usertype'])
				->where('ownerID', $data['userID'])
				->first();

		if($notification == null){
			return "404";
		} else {
			$notification->viewed = 1;
			$notification->save();
			return $this->getnotifications($data);
		}
	}

	public function addpricelist($data){
		if(!isset($data['title'])){
			return "500";	
		}else if(!isset($data['typeID'])){
			return "500";	
		}else if(!isset($data['price'])){
			return "500";
		}else if(!isset($data['detail'])){
			$data['detail'] == "";
		}

		$newprice = new Pricelist();
		$newprice->typeID = $data['typeID'];
		
		$newprice->title= $data['title'];
		$newprice->detail = $data['detail'];
		$newprice->price = $data['price'];
		$newprice->save();

		return $this->getpricelists();
	}

	public function getpendingcarts($roleID){
		$carts = Cartheader::with('cartdetail')
				->with('customer')
				->with('jobsubtype')
				->with('cartfile')
				->with('delivery')
				->doesntHave('salesdetail')
				->orderBy('id', 'desc')
				->get();

		return $carts;
	}

	public function getpricetypes(){
		$pricetypes = Pricetype::orderBy('id', 'asc')
				->get();

		return $pricetypes;
	}

	public function getallsales($roleID){
		$salesheaders = Salesheader::with('customer', 'salesdetail')
				->orderBy('id', 'desc')
				->get();
		return $salesheaders;
	}

	public function getpricelists(){
		//CUMA BOLEH BAGIAN ATAS
		$pricelists = Pricelist::with('pricetype')
				->orderBy('updated_at')
				->orderBy('created_at')
				->orderBy('id')
				->get();

		return $pricelists;
	}

	public function select(Request $request, $value){
		$data = $request->all();

		$result = $this->verify($data);
		if($result != "200"){
			return $result;
		}

		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //

		if($value == "customers" && $data['usertype'] == "EM"){
			return $this->getcustomers($data, $this->roleID);
		}else if($value == "notifications"){
			return $this->getnotifications($data);
		}else if($value == "pendingcarts"){
			return $this->getpendingcarts($this->roleID);
		}else if($value == "allsales"){
			return $this->getallsales($this->roleID);
		}else if($value == "pricelists"){
			return $this->getpricelists();
		}else if($value=="pricetypes"){
			return $this->getpricetypes();
		}else{
			return "VALUE BELOM DI DAFTAR";
		}
	}

	public function insert(Request $request, $value){
		$data = $request->all();

		$result = $this->verify($data);
		if($result != "200"){
			return $result;
		}

		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //

		if($value == "pricelists"){
			return $this->addpricelist($data);
		}
	}

	public function update(Request $request, $value){
		$data = $request->all();

		$result = $this->verify($data);
		if($result != "200"){
			return $result;
		}

		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //

		if($value == "notifications"){
			return $this->updatenotification($data);
		}
	}

	public function verify($data){
		if(!isset($data['userID']))
			return "500";
		$userID = $data['userID'];
		if(!isset($data['usertype']))
			return "500";
		$usertype = $data['usertype'];
		if(!isset($data['app_token']))
			return "500";
		$app_token = $data['app_token'];
		$this->roleID = "";

		if($usertype == "CU"){
			$customer = Customer::where('id', $userID)
				->where('app_token', $app_token)
				->first();
			if($customer == null){
				//TIDAK KETEMU
				return "403";
			}
			else{
				//LANJUT KEBAWAH
				return "200";
			}
		}else if($usertype == "EM"){
			$employee = Employee::where('id', $userID)
				->where('app_token', $app_token)
				->first();
			if($employee == null){
				return "403";
			}
			else{
				$this->roleID = $employee['roleID'];

				//PROSES KE SELECT
				return "200";
			}
		}else{
			return "500";
		}
	}

	public function login(Request $request){
		$datas = $request->all();

		if($datas['onesignalID']!=null){
			$user = Employee::where('email', $datas['username'])
					->first();
			if($user != null)
			{
				$onlinepass = $datas['password'];
				if(!Hash::check($onlinepass, $user['password'])){
					return array(0, "Employee Password was incorrect.");
				}

				//EMPLOYEE
				$user->app_token = Hash::make(Carbon::now());
				$user->save();

				$appdata = Onesignal::where('player_id', $datas['onesignalID'])
						->first();
				if($appdata==null){
					//NOT REGISTERED YET
					//INSERT ULANG
					$appdata = new Onesignal();
					$appdata->ownertype = "EM";
					$appdata->ownerID = $user->id;
					$appdata->player_id = $datas['onesignalID'];
					$appdata->active = 1;
					$appdata->save();
				}
				else{
					//UPDATE GANTI ORANG
					$appdata->ownertype = "EM";
					$appdata->ownerID = $user->id;
					$appdata->active = 1;
					$appdata->updated_at = Carbon::now();
					$appdata->save();
				}
			}
			else{
				$user = null;
				$user = Customer::where('email', $datas['username'])
						->first();
				if($user != null){
					//CUSTOMER

					$onlinepass = $datas['password'];
					if(!Hash::check($onlinepass, $user['password'])){
						return array(0, "Customer Password was incorrect.");
					}


					$user->app_token = Hash::make(Carbon::now());
					$user->save();


					$appdata = Onesignal::where('player_id', $datas['onesignalID'])
						->first();
					if($appdata==null){
						//NOT REGISTERED YET
						//INSERT LAGI
						$appdata = new Onesignal();
						$appdata->ownertype = "CU";
						$appdata->ownerID = $user->id;
						$appdata->player_id = $datas['onesignalID'];
						$appdata->active = 1;
						$appdata->save();
					}
					else{
						//UPDATE GANTI ORANG
						$appdata->ownertype = "CU";
						$appdata->ownerID = $user->id;
						$appdata->active = 1;
						$appdata->updated_at = Carbon::now();
						$appdata->save();
					}
				}else{
					//KALO GA KETEMU
					return array(0, "User not found");
				}
			}
			return array(1, $user->app_token, $user);
		}

		return $datas;
	}
}
