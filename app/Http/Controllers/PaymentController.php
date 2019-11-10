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

	public function createWorkOrderPDF($id)
	{
		//return view('test');
		$pdf = PDF::loadHTML('dompdf.wrapper');
		//$option = new Options();
		//$pdf->set_option('defaultFont', 'Courier');
		//$pdf = new PDF()
		$sales = Salesheader::join('customers', 'customerID', '=', 'customers.id')
				->where('salesheaders.id', '=', $id)
				->select('customers.*', 'salesheaders.*')
				->first();

		if(count($sales) == 0)
			return view('errors.forbidden');

		$phone = "";
		if ($sales['phone1'] != "") $phone .= $sales['phone1'];
		if ($sales['phone2'] != "") {
			if ($phone != "") $phone .= " / ";
			$phone .= $sales['phone2'];
		}
		if ($sales['phone3'] != "") {
			if ($phone != "") $phone .= " / ";
			$phone .= $sales['phone3'];
		}
		$sales['phone'] = $phone;

		$sales['details'] = Salesdetail::join('cartdetails', 'cartdetailID', '=', 'cartdetails.id')
				->join('papers', 'papers.id', '=', 'paperID')
				->join('papertypes', 'papertypes.id', '=', 'papertypeID')
				->join('vendors', 'vendors.id', '=', 'vendorID')
				->where('salesID', '=', $sales['id'])
				->select('papertypes.name as papertype', 'papers.gramature', 'papers.name as papername', 'cartdetails.*', 'vendors.name as papershop', 'papers.color as papercolor')
				->get();

		foreach ($sales['details'] as $i => $detail) {
			$temp = Delivery::where('id', '=', $detail['deliveryID'])
				->first();	
			$sales['details'][$i]['delivery'] = $temp;

			$temp2 = Cartdetailfinishing::join("finishings", 'finishings.id', '=', 'cartdetailfinishings.finishingID')
					->join('finishingoptions', 'finishingoptions.finishingID', '=', 'finishings.id')
					->where('cartdetailfinishings.cartdetailID', '=', $detail['id'])
					->select('finishings.shortname as finishingname', 'finishingoptions.optionname', 'finishingoptions.optionID AS a', 'cartdetailfinishings.optionID AS b')
					->get();

			foreach ($temp2 as $j => $item) {
				if($item['a']!=$item['b'])
					unset($temp2[$j]);
			}
			$sales['details'][$i]['finishings'] = $temp2;


			$dt = new DateTime($sales['created_at']);
			$d = $dt->format('d');
			$m = $dt->format('m');
			$y = $dt->format('Y');
			$h = $dt->format('H');
			$mn = $dt->format('i');
			$s = $dt->format('s');
			$z = 'Asia/Jakarta';
			$mulai = Carbon::create($y, $m, $d, $h, $mn, $s, $z);
			$deadline = $mulai->addWeekdays(intval($sales['details'][$i]['processtime']) + intval($sales['details'][$i]['deliverytime']))->toDateString();
			$sales['details'][$i]['deadline'] = $deadline;
			$mulai = Carbon::create($y, $m, $d, $h, $mn, $s, $z);
			$afterprint = $mulai->addWeekdays(intval($sales['details'][$i]['processtime']))->toDateString();
			$sales['details'][$i]['afterprint'] = $afterprint;
		}

		$sales['payment'] = Salespayment::leftjoin('salespaymentverifs', 'salespayments.id', '=', 'paymentID')
				->where('salespayments.salesID', '=', $sales['id'])
				->select('salespaymentverifs.*', 'salespayments.*')
				->first();


		//$pdf->loadHTML($html);
		$pdf->loadHTML(view('printforms.workorder', compact('sales')));
		$pdf->setPaper('A5', 'landscape');
		//$pdf->render();
		return $pdf->stream('WorkOrder.pdf');
	}
}
