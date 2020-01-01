<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerAJAX extends Controller
{

	public function getName()
	{
		$customers = Customer::select('id', 'name', 'phone1', 'phone2', 'email')
				->get();
		if(count($customers)==0)
			return null;
		return json_encode($customers);
	}

	public function getSalesByCustID($id){

		$sales = Customer::with('salesheader')
				->with('company')
				->where('id', '=', $id)
				->first();

		if($sales == null)
			return null;

		$totalbayar = 0;
		$totalprintprice = 0;
		$totaldeliveryprice = 0;
		$totaldiscount = 0;
		$totalbuyprice = 0;
		foreach ($sales['salesheader'] as $i => $salesheader) {
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
			$result['companyname'] = $sales['company']==null?'':$sales['company']['name'];
			if($sales['company']!=null){
				$result['parentcompanyname'] = $sales['company']['parentcompany']==null?'':$sales['company']['parentcompany']['name'];
			}

			return $result;
		}else{
			return null;
		}

	}

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
