<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util;
use App\Customer;
use App\Company;
use App\City;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mail;
use App\Mail\VerifyMail;
use App\Logic\Curl\OneSignal;
use App\Helpers\MathHelper;

class CustomerAPI extends Controller
{
	public function makesession($id){
		$item = Customer::findOrFail($id);
		if($item == null){
			return null;
		}else{
			$a = Carbon::parse($item['updated_at']);
			$b = Carbon::now();
			$diff = $a->diffInSeconds($b);
			$item->makeVisible(['remember_token']);

			if($diff > 600){ 
				// kalo uda 10 menit lebih session expired
				// jadi kalo uda lebih dari 10 menit di buat baru
				$item->remember_token = substr(str_replace('/', '', Hash::make(Carbon::now())), 20, 10);
				$item->save();
				return $item->remember_token;
			}else{
				//kalo belom 10 menit, tinggal show remmeber token
				return $item->remember_token;
			}
		}
	}

	public function getsession($id){
		$item = Customer::findOrFail($id);
		if($item == null){
			return null;
		}else{
			$a = Carbon::parse($item['updated_at']);
			$b = Carbon::now();
			$diff = $a->diffInSeconds($b);
			$item->makeVisible(['remember_token']);

			if($diff > 600){
				// kalo lebih dari 10 menit, return null
				return null;
			}else{
				return $item->remember_token;
			}
		}
	}

	public function apiGetName()
	{
		$customers = Customer::select('id', 'name', 'address')
				->get();
		if(count($customers)==0)
			return null;
		return json_encode($customers);
	}

	public function apiGetSalesByCustID($id){

		$sales = Customer::with('salesheader')
				->with('company')
				->where('id', '=', $id)
				->first();

		if($sales == null)
			return null;

		foreach ($sales['salesheader'] as $i => $salesheader) {
			$totalbayar = 0;
			$totalprintprice = 0;
			$totaldeliveryprice = 0;
			$totaldiscount = 0;
			$totalbuyprice = 0;
			foreach($salesheader['salesdetail'] as $j => $salesdetail){
				$totalprintprice += $salesdetail['cartheader']['printprice'];
				$totaldiscount += $salesdetail['cartheader']['discount'];
				$totaldeliveryprice += $salesdetail['cartheader']['deliveryprice'];
				$totalbuyprice += $salesdetail['cartheader']['buyprice'];
			}
			foreach($salesheader['salespayment'] as $k => $salespayment){
				//KALO UDA VERIF BARU DI ITUNG UDA BAYAR
				if($salespayment['salespaymentverif']!=null)
					$totalbayar += $salespayment['ammount'];
			}
		}

		if(count($sales['salesheader'])>0)
		{
			$result['totalpayment'] = $totalbayar;
			$result['totaltransaction'] = count($sales['salesheader']);
			$result['totaldiscount'] = $totaldiscount;
			$result['totalprintprice'] = $totalprintprice;
			$result['totaldeliveryprice'] = $totaldeliveryprice;

			$totalbelanja = $totalprintprice + $totaldeliveryprice - $totaldiscount;
			if($totalbayar > $totalbelanja)
				$result['totaldebt'] = 0;
			else
				$result['totaldebt'] = $totalbelanja - $totalbayar;
			$result['totalsales'] = $totalbelanja;

			return $result;
		}else{
			return null;
		}

	}

	public function store(Request $request)
	{
		//CustomerModel::create(Request::all());
		$data = $request->all();
		$data['password'] = Hash::make($data['password']);
		$data['balance'] = 0;
		$data['remember_token'] = null;

		$hasil = Customer::where('email', '=', $data['email'])
				->first();

		if($hasil != null){
			$result = array("message"=>"Telah terdaftar! Jika lupa password, silahkan ke bagian 'Forget Password'", "code"=>0);
			return $result;
		}
	 
		// $hasil->makeVisible(["verify_token", "updated_at"]);

		//comment dari sini tgl 12 agustus 2019
		// $emptytoken = false;
		// if($hasil["verify_token"]==null){
		// 	$emptytoken = true;
		// }else{
		// 	if($hasil["verify_token"]==""){
		// 		$emptytoken = true;
		// 	}
		// }

		// if($emptytoken == false){
		// 	$a = Carbon::parse($hasil['updated_at']);
		// 	$b = Carbon::now();
		// 	$diff = $a->diffInSeconds($b);
			
		// 	if($diff > 600){
		// 		// kalo lebih dari 10 menit, reset lagi

		// 	}else{
		// 		return $item->remember_token;
		// 	}
		// }
		//sampai sini

		Customer::create($data);
		//comment dulu biar gak perlu verif
		//updated 12 agustus 2019
		// $customer = Customer::orderBy('id', 'desc')
		//     ->first();
		// $customer->verify_token = str_random(40);

		//$customer->save();

		//comment dulu biar gak perlu verif
    //updated 12 agustus 2019
		// Mail::to($customer->email)->send(new VerifyMail($customer));

		// $notif = new OneSignal();
		// $result = $notif->sendMessage('SIGN-UP NEW CUSTOMER','SIGN-UP: '.$data['email'].' pada '.Carbon::now());
		//comment sampe sini

		//return $result; //'SIGN-UP: '.$data['email'].' pada '.Carbon::now();

		$msg = "Terimakasih! Silahkan Login Menggunakan Email Anda.";
		$result = array("message"=>$msg, "code"=>1);
		//echo json_encode($result);
		return $result;
	}

	public function resend(Request $request)
	{
		$data = $request->all();

		if(!isset($data['email'])){
			return "NO DATA, tidak bisa untuk mengirim ke email,\n mohon hubungi Customer Service kami (code:801).";
		}

		$email =  $data['email'];

		if($data == null || $email == null){
			return "NO DATA, tidak bisa untuk mengirim ke email,\n mohon hubungi Customer Service kami (code:802).";
		}

		$customer = Customer::where('email', $email)
				->first();

		if($customer == null){
			return "ERROR email, tidak ditemukan pada database,\n mohon lakukan registrasi ulang (code:803).";
		}else{
			$checkverif = Customer::where('email', '=', $email)
					->first();

			if($checkverif != null)
			{
				$a = Carbon::now();
				$b = Carbon::parse($checkverif['updated_at']);

				$difftime = $b->diffInSeconds($a);
				if($difftime >= 100)
				{
					$checkverif->verify_token = MathHelper::numRandom(16);//str_random(40);
					$checkverif->save();
				}
				Mail::to($checkverif->email)->send(new VerifyMail($checkverif));
			}    
			return "success";
		}
	}
}
