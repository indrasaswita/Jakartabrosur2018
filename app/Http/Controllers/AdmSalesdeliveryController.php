<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use PDF;
use App\Salesdelivery;

class AdmSalesdeliveryController extends Controller
{
    public function print($id){
    	$salesdeliveryID = $id;

    	$header = Salesdelivery::where('id', '=', $salesdeliveryID)
    							->with('delivery')
    							->with('salesdeliverydetail')
    							->with('salesheader')
    							->with('employee')
    							->first();

			if($header == null)
				return view('errors.forbidden');
			else{
				$pdf = PDF::loadHTML('dompdf.wrapper');

				$pdf->loadHTML(view('printforms.emp-cetakdelivery', compact('header')));
				$pdf->setPaper('A5', 'landscape');

				return $pdf->stream('surat-jalan.pdf');
			}

    	return 'error - AdmSalesdeliveryController';
    }
}
