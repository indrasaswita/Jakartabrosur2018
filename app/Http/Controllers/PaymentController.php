<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesheader;
use App\Salesdetail;
use App\Salespayment;
use App\Salesdelivery;
use App\Delivery;
use App\Cartdetailfinishing;
use App\Finishing;
use App\Files;
use App\Cartfile;
//use App\Http\Requests\PaymentConfirmStoreRequest;
use DB;
use PDF;
use DateTime;
use Carbon\Carbon;

class PaymentController extends Controller
{

	public function show($id)
	{
		// BUAT MUNCULIN HALAMAN PAYMENT, YANG DULU DI BUAT KEPISAH dengan Sales/all
		//sekarang sudah di apus	

		//BELOM KEPAKE

		$customerID = session()->get('userid');

		$allsales = Salesheader::with('salespayment', 'salesdetail', 'Salesdelivery', 'customer')
				->where('id', '=', $id)
				->where('customerID', '=', $customerID)
				->get();

		foreach ($allsales['salespayment'] as $i => $item) {
			if ($item['verifID'] == null)
				$item['verif'] = 'no';
			else
				$item['verif'] = 'ok';
		}

		return view('pages.order.payment', compact('allsales'));
	}


	public function confirmShow($id)
	{
		$customerID = session()->get('userid');

		$salesheader = Salesheader::with('salesdetail')
				->with('salesdetail')
				->with('salespayment')
				->where('id', '=', $id)
				->first();


		if($salesheader['customerID'] != $customerID)
			return view('errors.notfound');

		return view('pages.order.sales.payment.confirm', compact('salesheader'));
	}

	public function confirmStore(Request $request)
	{
		$input = $request->all();
		$customeraccID = $input['custacc'];
		$companyaccID = $input['compacc'];
		$paydate = substr($input['paydate'], 0, 10);
		$ammount = $input['totaltransfer'];
		$note = $input['confirmnote'];
		$salesID = $input['salesID'];

		/*$salesdetails = Salesdetail::with('cartheader')
								->where('salesID', '=', $salesID)
								->get();
		$total = 0;
		foreach ($salesdetails as $i => $salesdetail) {
			$cart = $salesdetail['cartheader'];
			$total += ($cart['printprice'] + $cart['deliveryprice'] - $cart['discount']);
		}
		*/

	
		$input = array();
		//$input['id'] = $newid;
		$input['salesID'] = $salesID;
		$input['customeraccID'] = $customeraccID;
		$input['companyaccID'] = $companyaccID;
		$input['paydate'] = $paydate;
		$input['ammount'] = $ammount;
		$input['type'] = "TRANSFER";
		$input['note'] = "!".$note;
		$input['created_at'] = Carbon::now();
		$input['updated_at'] = Carbon::now();

		DB::table('salespayments')
			->insert($input);


		return "success";
	}

	public function getAllInoviceData($id){
		$sales = Salesheader::with('salespayment', 'salesdetail', 'salesdelivery', 'customer')
				->where('id', '=', $id)
				->first();


		foreach ($sales['salesdetail'] as $i => $detail) {
			$dt = new DateTime($sales['created_at']);
			$d = $dt->format('d');
			$m = $dt->format('m');
			$y = $dt->format('Y');
			$h = $dt->format('H');
			$mn = $dt->format('i');
			$s = $dt->format('s');
			$z = 'Asia/Jakarta';
			$mulai = Carbon::create($y, $m, $d, $h, $mn, $s, $z);
			$deadline = $mulai->addWeekdays(intval($detail['cartheader']['processtime']) + intval($detail['cartheader']['deliverytime']))->toDateString();
			$detail['cartheader']['deadline'] = Carbon::parse($deadline)->format('D, d M \'y');
			$mulai = Carbon::create($y, $m, $d, $h, $mn, $s, $z);
			$afterprint = $mulai->addWeekdays(intval($detail['cartheader']['processtime']))->toDateString();
			$detail['cartheader']['afterprint'] = Carbon::parse($afterprint)->format('D, d M \'y');
		}

		return $sales;
	}

	public function showInvoiceAdmin($id){
		$sales = $this->getAllInoviceData($id);

		return view('printforms.html-smallinvoice', compact('sales'));
	}

	public function createInvoicePDF($id)
	{
		$pdf = PDF::loadHTML('dompdf.wrapper');


		$sales = $this->getAllInoviceData($id);
//dd($sales);
		$pdf->loadHTML(view('printforms.invoice', compact('sales')));
		$pdf->setPaper('A4', 'portrait');
		//$pdf->render();
		return $pdf->stream('invoice.pdf');
	}

	public function createOfferingPDF($id)
	{
		$pdf = PDF::loadHTML('dompdf.wrapper');
		
		$sales = Salesheader::with('salespayment', 'salesdetail', 'Salesdelivery', 'customer')
				->where('id', '=', $id)
				->first();

		foreach ($sales['salesdetail'] as $i => $detail) {
			$dt = new DateTime($sales['created_at']);
			$d = $dt->format('d');
			$m = $dt->format('m');
			$y = $dt->format('Y');
			$h = $dt->format('H');
			$mn = $dt->format('i');
			$s = $dt->format('s');
			$z = 'Asia/Jakarta';
			$mulai = Carbon::create($y, $m, $d, $h, $mn, $s, $z);
			$deadline = $mulai->addWeekdays(intval($detail['cartheader']['processtime']) + intval($detail['cartheader']['deliverytime']))->toDateString();
			$detail['cartheader']['deadline'] = Carbon::parse($deadline)->format('D, d M \'y');
			$mulai = Carbon::create($y, $m, $d, $h, $mn, $s, $z);
			$afterprint = $mulai->addWeekdays(intval($detail['cartheader']['processtime']))->toDateString();
			$detail['cartheader']['afterprint'] = Carbon::parse($afterprint)->format('D, d M \'y');
		}


		$pdf->loadHTML(view('printforms.penawaran', compact('sales')));
		$pdf->setPaper('A4', 'portrait');
		return $pdf->stream('penawaran.pdf');
	}
	
}
