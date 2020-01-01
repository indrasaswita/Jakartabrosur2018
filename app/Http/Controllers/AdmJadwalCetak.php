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
		$role = session()->get('role');
		if($role == null){
			abort('403');
		}

		//return view('test');
		$pdf = PDF::loadHTML('dompdf.wrapper');
		//$option = new Options();
		//$pdf->set_option('defaultFont', 'Courier');
		//$pdf = new PDF()

		$printername = "SM52";
		$details = Salesdetail::with('salesheader')
				->with(['cartheader' => function($query) use ($printername){
					$query->with(['cartdetail' => function($query2) use ($printername){
						$query2->with(['printer' => function($query3) use ($printername){
							$query3->where('machinename', $printername);
						}]);
					}]);
				}])
				->get();

		if($details == null)
			return abort('403');
		if(count($details) == 0)
			return abort('403');


		//$pdf->loadHTML($html);
		$pdf->loadHTML(view('printforms.adm-cetakharian', compact('details')));
		$pdf->setPaper('A4', 'portrait');
		//$pdf->render();
		return $pdf->stream('penawaran.pdf');
	}
}
