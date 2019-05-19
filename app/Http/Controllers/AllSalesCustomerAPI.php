<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Salesdetail;
use App\Salesheader;
use App\Salespayment;
use App\Salespaymentverif;
use DB;
use Carbon\Carbon;

class AllSalesCustomerAPI extends Controller
{
	public function commit($id)
	{
		//harus buat cartID, jadi commitnya itu per cartdetailID dan salesID
		//diganti jadi id dari salesdetail aja cukup
		$customerID = session()->get('userid');
		$sales = Salesdetail::where('id', '=', $id)
							->with('salesheader')
							->select('salesID', 'cartID', 'commited')
							->first();

		if($sales==null)
			return "Empty salesdetail..";

		if($customerID ==
			$sales['salesheader']['customerID'])
		{
			//berarti ketemu
			//ubah data jadi commited
			DB::table('salesdetails')
					->where('salesID', '=', $sales['salesID'])
					->where('cartID', '=', $sales['cartID'])
					->update(['commited'=>1]);

			$sales = Salesdetail::where('cartID', '=', $sales['cartID'])
							->where('salesID', '=', $sales['salesID'])
							->select('salesID', 'cartID', 'commited')
							->first();
		}
		else
		{
			return "Not your authority..";
		}

		return "success";
	}

	public function filterorder($id)
	{
		$customerID = session()->get('userid');
		if($id == 1) //ini untuk yang belum bayar
		{
			$allsales = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereNotIn('id', function($query){
					$query->select('salesID')->from('salespayments');
				})
				->orderBy('id', 'desc')
				->get();
		}
		else if($id == 2) //ini untuk proses
		{
			$allsales = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereIn('id', function($query){
					$query->select('salesID')->from('salespayments')
						->join('salespaymentverifs', 'salespayments.id', '=', 'salespaymentverifs.paymentID');
				})
				->whereIn('id', function($query){
					$query->select('salesID')->from('salesdetails')
						->where('statusdone', '<>', '1');
				})
				->orderBy('id', 'desc')
				->get();
		}
		else if($id == 3) //ini untuk complete
		{
			$allsales = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereIn('id', function($query){
					$query->select('salesID')->from('salesdetails')
						->where('statusdone', '=', '1');
				})
				->orderBy('id', 'desc')
				->get();
		}
		else if($id == 4) //ini untuk pengiriman
		{
			$allsales = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereIn('id', function($query){
					$query->select('salesID')->from('salesdetails')
						->where('statusdelivery', '=', '1')
						->where('statusdone', '=', '0');
				})
				->orderBy('id', 'desc')
				->get();
		}
		else
		{
			$allsales = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->orderBy('id', 'desc')
				->get();
		}

		return $allsales;
		
	}
}
