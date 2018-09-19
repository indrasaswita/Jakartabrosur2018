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


class AdmTrackingController extends Controller
{
	public function __construct()
	{
		$this->middleware('employee');
	}
	public function index()
	{
		$headers = Salesheader::join('customers', 'customers.id', '=', 'customerID')
				->select('customers.name as customername', 'customers.email as customeremail', 'customerID', 'salesheaders.id as salesID', 'salesheaders.created_at as salesTime', 'salesheaders.updated_at as lastUpdate')
				->orderBy('salesheaders.id', 'desc')
				->get();
		foreach ($headers as $i => $header) {
			$details = Salesdetail::where("salesID", '=', $header['salesID'])
					->select('cartdetailID', 'prioritylevel', 'statusfile', 'commited', 'statusctp', 'statusprint', 'statuspacking', 'statusdelivery', 'statusdone')
					->get();

			$totalprice = 0;
			foreach($details as $j => $detail){
				$cartdetail = Cartdetail::join('jobsubtypes', 'jobsubtypes.id', '=', 'jobsubtypeID')
						->join('papers', 'papers.id', '=', 'paperID')
						->join('vendors', 'vendors.id', '=', 'vendorID')
						->join('papersizes', 'papersizes.id', '=', 'planoID')
						->join('deliveries', 'deliveries.id', '=', 'deliveryID')
						->where('cartdetails.id', '=', $detail['cartdetailID'])
						->select('jobtitle', 'jobsubtypes.name as jobsubtypename', 'jobtype', 'printername', 'quantity', 'quantitytypename', 'imagewidth', 'imagelength', 'papers.name as papername', 'papers.gramature', 'papers.color', 'sideprint', 'filestatus', 'cartdetails.created_at as cartTime', 'deliveryname', 'printprice', 'deliveryprice', 'discount')
						->first();
				$detail['cartdetail'] = $cartdetail;
				$totalprice += $detail['cartdetail']['printprice']+$detail['cartdetail']['deliveryprice']-$detail['cartdetail']['discount'];
			}
			$headers[$i]['totalprice'] = $totalprice;

			$payments = Salespayment::leftjoin('salespaymentverifs', 
					function($join){
						$join->on('salespayments.id', '=', 'paymentID');
						$join->on('salespayments.salesID', '=', 'salespaymentverifs.salesID');
					}
				)
				->where('salespaymentverifs.veriftime', '<>', null)
				->where('salespayments.salesID', '=', $header['salesID'])
				->select(DB::raw('SUM(ammount) as totalbayar'))
				->first();

			$headers[$i]['totalpayment'] = $payments['totalbayar']==null?0:$payments['totalbayar'];

			$headers[$i]['details'] = $details;

			$customer = Customer::where('id', '=', $header['customerID'])
					->first();
			$headers[$i]['customer'] = $customer;
		}
		return view('pages.admin.trackings.index', compact('headers'));
	}
}
