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
use App\Http\Requests;
use App\Http\Requests\PaymentConfirmStoreRequest;
use DB;
use PDF;
use DateTime;
use Carbon\Carbon;

class AdmJadwalCetak extends Controller
{
	public function createJadwalCetakPDF()
	{
		//return view('test');
		$pdf = PDF::loadHTML('dompdf.wrapper');
		//$option = new Options();
		//$pdf->set_option('defaultFont', 'Courier');
		//$pdf = new PDF()
		$details = Salesdetail::join('salesheaders', 'salesID', '=', 'salesheaders.id')
				->join('cartdetails', 'cartdetailID', '=', 'cartdetails.id')
				->join('customers', 'salesheaders.customerID', '=', 'customers.id')
				->where('printername', '=', 'SM52')
				->select('salesdetails.*', 'cartdetails.*', 'salesheaders.*', 'customers.name as customername', 'salesheaders.created_at as salestime')
				->get();

		if($details == null)
			return view('errors.forbidden');
		if(count($details) == 0)
			return view('errors.forbidden');


		//$pdf->loadHTML($html);
		$pdf->loadHTML(view('printforms.adm-cetakharian', compact('details')));
		$pdf->setPaper('A4', 'portrait');
		//$pdf->render();
		return $pdf->stream('penawaran.pdf');
	}
}
