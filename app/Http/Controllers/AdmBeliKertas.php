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

class AdmBeliKertas extends Controller
{
	public function createBeliKertasPDF()
	{
		//return view('test');
		$pdf = PDF::loadHTML('dompdf.wrapper');
		//$option = new Options();
		//$pdf->set_option('defaultFont', 'Courier');
		//$pdf = new PDF()
		$details = Salesdetail::join('salesheaders', 'salesID', '=', 'salesheaders.id')
				->join('cartdetails', 'cartdetailID', '=', 'cartdetails.id')
				->join('customers', 'salesheaders.customerID', '=', 'customers.id')
				->join('papers', 'papers.id', '=', 'paperID')
				->join('vendors', 'vendors.id', '=', 'vendorID')
				->join('papersizes', 'papersizes.id', '=', 'planoID')
				->where('printername', '=', 'SM52')
				->select('jobtitle', 'quantity', 'totalpaperprice', 'quantitytypename', 'totalplano', 'printwidth', 'printlength', 'totalinplano', 'totalinplanox', 'totalinplanoy', 'totalinplanorest', 'papersizes.width as planowidth', 'papersizes.length as planolength', 'papers.name as papername', 'papers.gramature', 'color', 'vendors.name as vendorname', 'vendors.phone1 as vendorphone1', 'vendors.phone2 as vendorphone2', 'customers.name as customername', 'salesheaders.created_at as salestime', 'customernote', 'employeenote', 'itemdescription')
				->get();

		if($details == null)
			return view('errors.forbidden');
		if(count($details) == 0)
			return view('errors.forbidden');

		//$pdf->loadHTML($html);
		$pdf->loadHTML(view('printforms.adm-kertasharian', compact('details')));
		$pdf->setPaper('A4', 'portrait');
		//$pdf->render();
		return $pdf->stream('penawaran.pdf');
	}
}
