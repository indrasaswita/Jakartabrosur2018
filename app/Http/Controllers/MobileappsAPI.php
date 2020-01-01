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
use App\Salespaymentverif;
use App\Customerbankacc;
use App\Companybankacc;
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

    public function getpendingcarts(){
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

    public function getallsales(){
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
                return $this->getallsales();
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
            }else if ($value == 'getsalesnopayment'){
                return $this->getsalesnopayment();
            }else if ($value == 'getpendingpayment'){
                return $this->getpendingpayment();
            }else if($value == 'getcompanybankaccount'){
                return $this->getcompanybankaccount();
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
            return null;
        if(!array_key_exists('onesignalID', $datas))
            return null;



        $cek = Employeeonesignal::where('app_token', $datas['app_token'])
                ->whereHas('onesignal', function($query) use ($datas){
                    $query->where('player_id', $datas['onesignalID']);
                })
                ->with('employee')
                ->first();

        if($cek == null)
            return null;

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

        return $datas;
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
