<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Salesheader;
use App\Salesdetail;
use App\Http\Requests;
use DB;
use Carbon\Carbon;
use App\Cartdetail;
use App\Salespayment;
use App\Customer;
use App\Salespaymentverif;


class AdmAllSalesAPI extends Controller
{
	public function __construct()
	{
		//$this->middleware('employee');
	}

	public function getAll(){
		$salesheaders = Salesheader::with('customer', 'salesdetail')
				->orderBy('id', 'desc')
				->get();
		return $salesheaders;
	}

	public function apiVerif(Request $request){
		$time = Carbon::now();
		$data = $request->all();
		$employee = session()->get('userid');
		$salesID = $data['salesID'];
		$paymentID = $data['paymentID'];
		$ammount = $data['ammount'];
		$verifnote = $data['verifnote'];
		$verif = Salespaymentverif::where('paymentID', '=', $paymentID)
				->with('salespayment')
				->first();
		//KALO MO ITUNG JUMLAH BELANJANYA JUGA BISA DARI SALES HEADER -> SALES DETAIL -> CARTHEADER

		if($verif == null)
		{
			$payment = Salespayment::find($paymentID);
			$bayar = $payment['ammount'];
			if ($ammount != $bayar)
				return "error";
			else
			{
				$verif = array();
				$verif['employeeID'] = session()->get('userid');
				$verif['paymentID'] = $paymentID;
				$verif['salesID'] = $salesID;
				$verif['note'] = $verifnote;
				$verif['veriftime'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')."";
				$verif['created_at'] = Carbon::now('Asia/Jakarta');
				$verif['updated_at'] = Carbon::now('Asia/Jakarta');
				Salespaymentverif::create($verif);

				$check = Salespaymentverif::where('paymentID', '=', $paymentID)
						->first();

				if($check!=null)
					return "success";
				else
					return "error";
			}
		}
		else
		{
			// SUDAH DI VERIF SEBELOMNYA GA BISA VERIF LAGI
			return "duplicated";
		}
		return null;
	}

	public function apiGetVerif(){
		$verifs = Salesheader::join('customers', 'customers.id', '=', 'customerID')
			->leftjoin('salespayments', 'salesheaders.id', '=', 'salespayments.salesID')
			->leftjoin('salespaymentverifs', 'paymentID', '=', 'salespayments.id')
			->leftjoin('customerbankaccs as cua', 'customeraccID', '=', 'cua.id')
			->leftjoin('companybankaccs as coa', 'companyaccID', '=', 'coa.id')
			->join('salesdetails', 'salesheaders.id', '=', 'salesdetails.salesID')
			->join('cartdetails', 'cartdetails.id', '=', 'cartdetailID')
			->leftjoin('banks as cub', 'cub.id', '=', 'cua.bankID')
			->leftjoin('banks as cob', 'cob.id', '=', 'coa.bankID')
			//->where(DB::raw('DATEDIFF(now(), salesheaders.created_at)'), '<', 2) //BELOM EXPIRED
			->where('salespayments.id', '<>', NULL) //SUDAH BAYAR
			->where('salespaymentverifs.id', '=', NULL) //BELOM DI VERIF
			->select('salesheaders.id as salesID', 'customers.name as customername', 'cua.accno as cuano', 'cua.acclocation as cualocation', 'cub.bankname as cubankname', 'cua.accname as cuaname', 'coa.accno as coano', 'coa.acclocation as coalocation', 'coa.accname as coaname', 'cob.bankname as cobankname', DB::raw('SUM(totalprice) as totalprice'), 'ammount', 'salesheaders.created_at as salesTime')
			->groupBy('salesheaders.id', 'customers.name', 'ammount')
			->get();
		return $verifs;
	}
}
