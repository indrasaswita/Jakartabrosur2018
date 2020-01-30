<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Customer;
use App\Customeronesignal;
use App\Employee;
use App\Employeeonesignal;
use App\Onesignal;
use App\Notification;
use App\Cartheader;
use App\Salesheader;
use App\Pricelist;
use App\Pricetype;
use App\Role;
use App\Paper;
use App\Salespayment;
use App\Salesdetail;
use App\Salespaymentverif;
use App\Customerbankacc;
use App\Companybankacc;
use App\Cartpreview;
use App\Bank;
use DB;


class MobileappsAPI extends Controller
{
	public function getcustomers(){
		$customers = Customer::orderBy('updated_at', 'desc')
				->orderBy('id', 'desc')
				->with('company')
				->with('salesheader')
				->with('customeraddress')
				->with('customeronesignal')
				->with('customerbankacc')
				->get();

		return $customers;
	}

	public function getcustomerpayment(){
		$customers = Customer::orderBy('updated_at', 'desc')
				->orderBy('id', 'desc')
				->with('company')
				->with('customerbankacc')
				->with('salesheader')
				->get();

		return $customers;
	}

	public function getbanks(){
		$banks = Bank::orderBy('alias')
				->where('alias', '<>', '')
				->get();

		$banks2 = Bank::orderBy('bankname')
				->where('alias', '')
				->get();

		$banks = $banks->merge($banks2);

		return $banks;
	}

	public function getroles(){
		$roles = Role::with('employee')
				->get();

		return $roles;
	}

	public function getnotifications($data){
		$notifications = Notification::where('ownerID', $data['userID'])
				->where('owner', $data['usertype'])
				->orderBy('created_at', 'desc')
				->orderBy('id', 'desc')
				->get();

		return $notifications;
	}

	public function getcustbankaccount($data){
		$customerbankacc = Customerbankacc::with('bank')
				->where('customerID', $data['customerID'])
				->orderBy('created_at', 'desc')
				->get();
		return $customerbankacc;
	}

	public function getcompanybankaccount(){
		$companybankacc = Companybankacc::with('bank')
				->orderBy('created_at', 'desc')
				->get();
		return $companybankacc;
	}

	public function getbanklist(){
	  $banklist = Bank::whereIn('alias', array('BCA', 'Mandiri', 'BRI', 'BNI 46'))
				->get();
	  return $banklist;
	}

	public function updatecustomerbankacc($data){
		$id = $data['id'];
		$custbankacc = Customerbankacc::find($id);

		if($custbankacc!=null){
			$custbankacc->accname = $data['accname']==null?"":$data['accname'];
			$custbankacc->accno = $data['accno']==null?"":$data['accno'];
			$custbankacc->acclocation = $data['acclocation']==null?"":$data['acclocation'];
			$custbankacc->bankID = $data['bankID'];
			$result = $custbankacc->save();

			if($result){
				return [1, "success"];
			}else{
				return [0, "failed to save"];
			}
		}else{
			return [0, "notfound"];
		}
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

	public function updatecommitcartpreview($data){
		if(!array_key_exists('cartpreviewID', $data)){
			return [0, 'cartpreviewID doesnt exists'];
		}

		$id = $data['cartpreviewID'];

		$cartpreview = Cartpreview::find($id);

		if($cartpreview == null){
			return [0, 'not found'];
		}else{
			if($cartpreview->commit == 1){
				return [0, 'already commited'];
			}else{
				$cartpreview->commit = 1;
				$cartpreview->comment="commit by admin, apps";
				$result = $cartpreview->save();

				if($result)
					return [1, "success"];
				else{
					return [0, 'cannot save'];
				}
			}
		}
	}

	public function updatestatussalesdetail($data){
		if(!array_key_exists('status', $data)){
			return [0, 'key status not found'];
		}
		if(!array_key_exists('click', $data)){
			return [0, 'key click not found'];
		}
		if(!array_key_exists('salesdetailID', $data)){
			return [0, 'key sdid not found'];
		}

		$id = $data['salesdetailID'];

		$nowstatus = $data['status']=="file"?1:
				($data['status']=="commit"?2:
				($data['status']=="ctp"?3:
				($data['status']=="print"?4:
				($data['status']=="packing"?5:
				($data['status']=="delivery"?6:
				($data['status']=="done"?7:0))))));
		$afterstatus = $data['click']=="file"?1:
				($data['click']=="commit"?2:
				($data['click']=="ctp"?3:
				($data['click']=="print"?4:
				($data['click']=="packing"?5:
				($data['click']=="delivery"?6:
				($data['click']=="done"?7:0))))));


		$result = false;
		$salesdetail = Salesdetail::find($id);

		if($salesdetail == null){
			return [0, 'salesdetail not found'];
		}

		if($afterstatus <= $nowstatus){
			$salesdetail->commited = $afterstatus>1?1:0;
			$salesdetail->commited = $afterstatus>2?1:0;
			$salesdetail->statusctp = $afterstatus>3?1:0;
			$salesdetail->statusprint = $afterstatus>4?1:0;
			$salesdetail->statuspacking = $afterstatus>5?1:0;
			$salesdetail->statusdelivery = $afterstatus>6?1:0;
			$salesdetail->statusdone = $afterstatus>7?1:0;
		}else if($afterstatus > $nowstatus){
			$salesdetail->commited = $afterstatus>=1?1:0;
			$salesdetail->commited = $afterstatus>=2?1:0;
			$salesdetail->statusctp = $afterstatus>=3?1:0;
			$salesdetail->statusprint = $afterstatus>=4?1:0;
			$salesdetail->statuspacking = $afterstatus>=5?1:0;
			$salesdetail->statusdelivery = $afterstatus>=6?1:0;
			$salesdetail->statusdone = $afterstatus>=7?1:0;
		}

		$result = $salesdetail->save();

		if($result){
			return [1, 'success'];
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

	public function getpendingcarts(){
		$carts = Cartheader::with('cartdetail')
				->with('customer')
				->with('jobsubtype')
				->with('cartfile')
				->with('delivery')
				->with('deliveryaddress')
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

	public function getpendingsales($data){
		//ga pake limit

		$sales = Salesheader::whereRaw('totalpayment<totalprice')
				->with('salesdetail', 'salespayment')
				->whereHas('salesdetail', function($q){
					$q->whereHas('cartheader', function($q2){
						$q2->whereHas('cartpreview', function($q3){
							$q3->where('commit', 0);
						});
					});
				})
				->orWhereHas('salesdetail', function($q){
					$q->where('statusdone', 0);
				})
				->get();

		return [1, $sales];
	}

	public function getallsales($data){
		$lastid = array_key_exists('lastid', $data) ? $data['lastid'] : 0;
		$lastload = array_key_exists('lastload', $data) ? $data['lastload'] : 0;
		$limit = array_key_exists('limit', $data) ? $data['limit'] : 18;

		$refreshall = true;

		if ($lastid == 0 || $lastload == 0) {
			$refreshall = true;
		} else {
			$lastheader = Salesheader::orderBy('id', 'desc')
					->first();
			if($lastheader == null){
				return null;
			}else{
				if($lastid == $lastheader['id']){
					//ambil page berikutnya (belom ada perubahan lastid)
					$refreshall = false;
				}else{
					//refresh all page (0-limit)
					$refreshall = true;
				}
			}
		}

		if ($refreshall == true) {
			$salesheaders = Salesheader::with('customer', 'salesdetail', 'salespayment')
					->offset(0)
					->limit($limit)
					->orderBy('id', 'desc')
					->get();

			$aslinya = Salesheader::count();

			foreach ($salesheaders as $i => $ii){
				if($ii['customer']!=null)
					$salesheaders[$i]['customer'] = $ii['customer']->makeVisible('balance');
			}

			if(count($salesheaders) >= $aslinya){
				return [2, $salesheaders];
			}else{
				return [1, $salesheaders];
			}
		} else {
			$salesheaders = Salesheader::with('customer', 'salesdetail', 'salespayment')
					->where('id', '<', $lastload)
					->offset(0)
					->limit($limit)
					->orderBy('id', 'desc')
					->get();

			$aslinya = Salesheader::where('id', '<', $lastload)
					->count();

			foreach ($salesheaders as $i => $ii){
				if($ii['customer']!=null)
					$salesheaders[$i]['customer'] = $ii['customer']->makeVisible('balance');
			}

			if(count($salesheaders) >= $aslinya){
				return [2, $salesheaders];
			}else{
				return [1, $salesheaders];
			}
		}

		//1 status belom habis
		//2 status sudah habis loadnya
		//0 status untuk error

		// -> return [status, $data];

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

	public function getemployees(){
		$employees = Employee::with('role')
				->with('employeeonesignal')
				->get();

		return $employees;
	}

	public function getpapers(){
		$employees = Paper::with('papertype')
				->with('paperdetail')
				->get();

		return $employees;
	}

	public function getsalespaymentverif($data){
	  $salespaymentverif = Salespaymentverif::where('paymentID', $data['salespaymentID'])
				->first();

	  return $salespaymentverif;
	}

	public function getusedcurl(){
	  $salespaymentverif = Salespaymentverif::with('companybankaccmutation')
				->where('customerbankmutationID', '<>', '')
				->get();

	  return $salespaymentverif;
	}

	public function getsalesnopayment(){
	  $salesheader = Salesheader::with('salesdetail')
					->with('customer')
					->doesntHave('salespayment')
				  //  ->orWhere('totalprice', '>', 'totalpayment')
					->get();
	  
	  return $salesheader;
	}

	public function getpendingpayment(){
	  $salesheader = Salesheader::with('salespayment')
					 ->with('salesdetail')
					 ->with('customer')
					 ->where('totalprice', '<=', 'totalpayment')
					 ->whereHas('salespayment', function($query){
					   $query->whereHas('salespaymentverif', function($q){
						$q->where('veriftime', '>=', Carbon::now());
					   });
					 })
					 ->orWhereHas('salespayment', function($query){
						$query->whereDoesntHave('salespaymentverif');
					 })
					 ->get();

	  return $salesheader;
	}

	public function getcustomertransaction($data){
		if(array_key_exists('custid', $data)){
			$customerID = $data['custid'];

			$salesheaders = Salesheader::where('customerID', $customerID)
					->with('salesdetail')
					->with('salespayment')
					->with('salesdelivery')
					->get();

			$cartheaders = Cartheader::where('customerID', $customerID)
					->doesntHave('salesdetail')
					->with('cartdetail')
					->with('jobsubtype')
					->get();

			return [1, $salesheaders, $cartheaders];
		}else{
			return [0, 'no customer id inputed'];
		}
	}

	public function test(Request $request, $value){
			$data = [];
			if($value == 'pendingsales'){
				return $this->getpendingsales($data);
			}
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

		if($data['usertype'] == "EM"){
			//admin role
			if($value == "customers"){
				return $this->getcustomers();
			}else if($value == "customerpayment"){
				return $this->getcustomerpayment();
			}else if($value == "roles"){
				return $this->getroles();
			}else if($value == "notifications"){
				return $this->getnotifications($data);
			}else if($value == "pendingcarts"){
				return $this->getpendingcarts();
			}else if($value == "allsales"){
				return $this->getallsales($data);
			}else if($value == "employees"){
				return $this->getemployees();
			}else if($value == "customers"){
				return $this->getcustomers();
			}else if($value == "pricelists"){
				return $this->getpricelists();
			}else if($value == "pricetypes"){
				return $this->getpricetypes();
			}else if($value == "papers"){
				return $this->getpapers();
			}else if($value == "getcustbankaccount"){
				return $this->getcustbankaccount($data);
			}else if($value == "getbanklist"){
				return $this->getbanklist();
			}else if($value == 'getsalespaymentverif'){
				return $this->getsalespaymentverif($data);
			}else if($value == 'usedcurl'){
				return $this->getusedcurl();
			}else if($value == 'getsalesnopayment'){
				return $this->getsalesnopayment();
			}else if($value == 'getpendingpayment'){
				return $this->getpendingpayment();
			}else if($value == 'getcompanybankaccount'){
				return $this->getcompanybankaccount();
			}else if($value == 'customertransaction'){
				return $this->getcustomertransaction($data);
			}else if($value == 'pendingsales'){
				return $this->getpendingsales($data);
			}else if($value == 'banks'){
				return $this->getbanks();
			}else{
				return "VALUE BELOM DI DAFTAR";
			}
		}else{
			return "Error: Forbidden";
		}
	}

	public function insert(Request $request, $value){
		$data = $request->all();

		$result = $this->verify($data);
		if($result != "200"){
			return $result;
		}
		else{
		  if($value == "pricelists"){
			return $this->addpricelist($data);
		  }else if($value == "insertverif"){
			  return $this->insertpaymentverif($data);
		  }else if($value == "insertcustomerbankacc"){
			  return $this->insertcustomerbankacc($data);
		  }else{
			  return "VALUE BELUM DI DAFTARKAN";
		  }
		}
		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //
		// PROSES SELCT QUERY //
	}

	public function insertcustomerbankacc($data){
	  $newcustomerbankaccs = new Customerbankacc;
	  $newcustomerbankaccs->customerID = $data['customerID'];
	  $newcustomerbankaccs->bankID = $data['bankID'];
	  $newcustomerbankaccs->accname = $data['custaccname'];
	  $newcustomerbankaccs->accno = $data['custaccno'];
	  $newcustomerbankaccs->acclocation = '';
	  $newcustomerbankaccs->save();

	  $customerbankacc = Customerbankacc::where('customerID', '=', $data['customerID'])
				->orderBy('id', 'DESC')
				->first();
	  if($customerbankacc != null)
	  {
		return $customerbankacc['id'];
	  }
	  else{
		return null;
	  }
	}

	public function insertpaymentverif($data){
		
		if($data['customerbankaccID'] == null){
		  $newcustomerbankaccs = new Customerbankacc;
		  $newcustomerbankaccs->customerID = $data['customerID'];
		  $newcustomerbankaccs->bankID = $data['bankID'];
		  $newcustomerbankaccs->accname = $data['accname'];
		  $newcustomerbankaccs->accno = '';
		  $newcustomerbankaccs->acclocation = '';
		  $newcustomerbankaccs->save();

		  $customerbankacc = Customerbankacc::where('customerID', '=', $data['customerID'])
				->orderBy('id', 'DESC')
				->first();
		  if($customerbankacc != null)
		  {
			$data['accountno'] = $customerbankacc['id'];
		  }
		  else{
			return null;
		  }
		}
		
		if($data['paymentID'] == null){
			$newpayment = new Salespayment();
			$newpayment->salesID = $data['salesID'];
			$newpayment->customeraccID = $data['accountno'];
			$newpayment->companyaccID = '1';
			$newpayment->paydate = $data['paydate'];
			$newpayment->note = $data['note'];
			$newpayment->ammount = $data['ammount'];
			$newpayment->type = 'TRANSFER';
			$newpayment->save();

			$salespayment = Salespayment::where('salesID', '=', $data['salesID'])
				->orderBy('id', 'DESC')
				->first();
			if($salespayment != null)
			{
			  $data['paymentID'] =  $salespayment['id'];
			}
			else{
			  return null;
			}
		}
		$newverif = new Salespaymentverif();
		$newverif->paymentID = $data['paymentID'];
		$newverif->employeeID = $data['userID'];
		$newverif->veriftime = Carbon::now();
		$newverif->customerbankmutationID = $data['customerbankmutationID'];
		$newverif->note = $data['note'];
		$newverif->save();

		$paymentverif = Salespaymentverif::where('paymentID', '=', $data['paymentID'])
			  ->orderBy('id', 'DESC')
			  ->first();
		if($paymentverif != null)
		{
		  return $paymentverif['id'];
		}
		else{
		  return null;
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
		}else if($value == "customerbankacc"){
			return $this->updatecustomerbankacc($data);
		}else if($value == "customerverify"){
			return $this->updatecustomerverify($data);
		}else if($value == "customerresetpassword"){
			return $this->updatecustomerresetpassword($data);
		}else if($value == "commitcartpreview"){
			return $this->updatecommitcartpreview($data);
		}else if($value == "statussalesdetail"){
			return $this->updatestatussalesdetail($data);
		}
	}

	public function updatecustomerresetpassword($data){
		if(array_key_exists('custid', $data)){
			$customerid = $data['custid'];

			$customer = Customer::find($customerid);

			if($customer == null){
				return ['0', 'no customer found'];
			}else{
				$customer->password = '';
				$result = $customer->save();

				if($result)
					return ['1', 'success'];
				else
					return ['0', 'failed to save'];
			}
		}else{
			return ['0', 'failed, no customerid'];
		}
	}

	public function updatecustomerverify($data){
		if(array_key_exists('custid', $data)){
			$customerid = $data['custid'];

			$customer = Customer::find($customerid);

			if($customer == null){
				return ['0', 'no customer found'];
			}else{
				$customer->verified = 1;
				$result = $customer->save();

				if($result)
					return ['1', 'success'];
				else
					return ['0', 'failed to save'];
			}
		}else{
			return ['0', 'failed, no customerid'];
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
				->with('customeronesignal')
				->first();

			if($customer == null){
				//TIDAK KETEMU
				return "403";
			}
			else{
				//LANJUT KEBAWAH
				
				$verified = false;
				foreach ($customer['customeronesignal'] as $i => $ii) {
					if($ii['app_token'] == $app_token){
						$verified = true;
					}
				}

				//PROSES KE SELECT
				if($verified)
					return "200";
				else
					return "501";

			}
		}else if($usertype == "EM"){
			$employee = Employee::where('id', $userID)
				->with('employeeonesignal')
				->first();

			if($employee == null){
				return "403";
			}
			else{
				$this->roleID = $employee['roleID'];

				$verified = false;
				foreach ($employee['employeeonesignal'] as $i => $ii) {
					if($ii['app_token'] == $app_token){
						$verified = true;
					}
				}

				//PROSES KE SELECT
				if($verified)
					return "200";
				else
					return "501";
			}
		}else{
			return "502";
		}
	}

	public function logout (Request $request){

	}

	public function cektoken (Request $request){
		$datas = $request->all();

		if(!array_key_exists('app_token', $datas))
			return [0, 'input not full (1)'];
		if(!array_key_exists('onesignalID', $datas))
			return [0, 'input not full (2)'];

		$cek = Employeeonesignal::where('app_token', $datas['app_token'])
				->whereHas('onesignal', function($query) use ($datas){
					$query->where('player_id', $datas['onesignalID']);
				})
				->with('employee')
				->first();

		if($cek == null)
			return [0, 'not found'];

		$token = $datas['app_token'];
		$usertype = 'EM';
		return array(1, $token, $cek['employee'], $usertype);
	}

	public function login(Request $request){
		$datas = $request->all();
		$usertype = '';

		if($datas['onesignalID']!=null){
			$user = Employee::with('employeeonesignal')
					->with('role')
					->where('email', $datas['username'])
					->first();
			$token = Hash::make(Carbon::now());

			if($user != null)
			{
				$usertype = 'EM';
				$onlinepass = $datas['password'];
				if(!Hash::check($onlinepass, $user['password'])){
					return array(0, "Employee Password was incorrect.");
				}

				//EMPLOYEE
				//if($user['employeeonesignal'] == null){
					//onesignal belom terdaftar
					// 1. dan cek onesignal sudah dipake belom
					// 2. kalo belom buat onesignal
					// 3. kalo uda ada onesigal, tinggal masukin ke link

					$onesignal = Onesignal::with('employeeonesignal')
							->where('player_id', $datas['onesignalID'])
							->first();

					if($onesignal == null){
						// kalo belom ada sebelomnya, di buat dulu
						$newonesignal = new Onesignal();
						$newonesignal->devicename = "No-name";
						$newonesignal->player_id = $datas['onesignalID'];
						$newonesignal->active = 1;
						$newonesignal->save();

						//update ke onesignal yg baru
						$onesignal = Onesignal::with('employeeonesignal')
							->where('player_id', $datas['onesignalID'])
							->first();

						if($onesignal == null){
							return array(0, "Cannot save new Onesignal records.");
						}
					}else{
						//kalo uda ada sebelomnya di cek ke employeeonesignal
						if($onesignal['employeeonesignal'] != null){
							if($onesignal['employeeonesignal']['customerID'] != $user['id']){
								Employeeonesignal::find($onesignal['employeeonesignal']['id'])->delete();
							}
						}
					}

					//cek dulu employeeonesignalnya ada ga?
					$employeeonesignal = Employeeonesignal::where('onesignalID', $onesignal['id'])
							->where('employeeID', $user['id'])
							->first();

					// sampe step ini, tidak ada EMployee onesignal
					// dan onesignal id sudah di tampung di $onesignal
					// 1. buat new employeeonesignal
					if($employeeonesignal == null){
						$employeeonesignal = new Employeeonesignal();
						$employeeonesignal->onesignalID = $onesignal['id'];
						$employeeonesignal->employeeID = $user['id'];
						$employeeonesignal->count = 0;
						$employeeonesignal->app_token = $token;
						$employeeonesignal->save();
					}else{
						$employeeonesignal->count++;
						$employeeonesignal->app_token = $token;
						$employeeonesignal->save();
					}
				//}
			}
			else{
				$user = null;
				$user = Customer::with('customeronesignal')
						->where('email', $datas['username'])
						->first();
				if($user != null){
					//CUSTOMER
					$usertype = 'CU';

					$onlinepass = $datas['password'];
					if(!Hash::check($onlinepass, $user['password'])){
						return array(0, "Customer Password was incorrect.");
					}


					//if($user['customeronesignal'] == null){
						//onesignal belom terdaftar
						// 1. dan cek onesignal sudah dipake belom
						// 2. kalo belom buat onesignal
						// 3. kalo uda ada onesigal, tinggal masukin ke link

						$onesignal = Onesignal::with('customeronesignal')
								->where('player_id', $datas['onesignalID'])
								->first();

						if($onesignal == null){
							// kalo belom ada sebelomnya, di buat dulu
							$newonesignal = new Onesignal();
							$newonesignal->devicename = "No-name";
							$newonesignal->player_id = $datas['onesignalID'];
							$newonesignal->active = 1;
							$newonesignal->save();

							//update ke onesignal yg baru
							$onesignal = Onesignal::with('customeronesignal')
								->where('player_id', $datas['onesignalID'])
								->first();

							if($onesignal == null){
								return array(0, "Cannot save new Onesignal records.");
							}
						}else{
							//kalo uda ada sebelomnya di cek ke employeeonesignal
							if($onesignal['customeronesignal'] != null){
								if($onesignal['customeronesignal']['customerID'] != $user['id']){
									Customeronesignal::find($onesignal['customeronesignal']['id'])->delete();
								}
							}
						}

						//cek dulu customeronesignalnya ada ga?
						$customeronesignal = Customeronesignal::where('onesignalID', $onesignal['id'])
								->where('customerID', $user['id'])
								->first();
						if($customeronesignal == null){
							// kalo ga ada
							// dan onesignal id sudah di tampung di $onesignal
							// 1. buat new customersignal
							$customeronesignal = new Customeronesignal();
							$customeronesignal->onesignalID = $onesignal['id'];
							$customeronesignal->customerID = $user['id'];
							$customeronesignal->count = 0;
							$customeronesignal->app_token = $token;
							$customeronesignal->save();
						}else{
							$customeronesignal->count++;
							$customeronesignal->app_token = $token;
							$customeronesignal->save();
						}
					//}

				}else{
					//KALO GA KETEMU
					return array(0, "User not found");
				}
			}

			return array(1, $token, $user, $usertype);
		}

		return [0, "Onesignal error"];
	}

	public function register(Request $request){
		$datas = $request->all();

		if(!array_key_exists('email', $datas)){
			return null;
		}

		if($datas['email']!=null){
			$customer = Customer::where('email', $datas['email'])
				->first();
				$msg = $customer;
			//dd($msg);
			if($customer != null){
				return $msg;
			}
			else{
				$newcustomer = new Customer();
				$newcustomer->companyID = null;
				$newcustomer->email = $datas['email'];
				$newcustomer->name = $datas['name'];
				$newcustomer->password = ''; 
				// password di set kosong kalo,
				// customer di daftarin dari employee
				// efeknya: nanti suruh set password pas login
				$newcustomer->type = 'personal';
				$newcustomer->title = $datas['title'];
				$newcustomer->phone1 = $datas['telp1'];
				$newcustomer->phone2 = $datas['telp2'];
				$newcustomer->phone3 = $datas['telp3'];
				$newcustomer->news = '0';
				$newcustomer->balance = '0';
				$newcustomer->remember_token = null;
				$newcustomer->verify_token = null;
				$newcustomer->save();
			}
		} else {
			return null;
		}
	}
}
