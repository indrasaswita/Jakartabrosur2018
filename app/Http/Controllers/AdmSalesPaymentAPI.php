<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Salespayment;
use DB;
use Carbon\Carbon;

class AdmSalesPaymentAPI extends Controller
{
    public function setPaymentByID($id, Request $request)
    {
    	//$id -> salesID
    	$data = $request->all();

    	$paydate = $data['paydate'];
    	$ammount = $data['ammount'];
    	$custacc = $data['custacc'];
    	$compacc = $data['compacc'];

    	$empID = session()->get('userid');

    	$payments = Salespayment::where('salesID', '=', $id)
    			->select('id')
    			->orderBy('id', 'desc')
    			->first();

    	/*if(count($payments) == 0)
    		$newid = 1;
    	else
    		$newid = $payments['id'] + 1;*/

    	DB::table('salespayments')
    		->insert(['salesID' => $id,
				'customeraccID' => $custacc,
				'companyaccID' => $compacc,
				'paydate' => $paydate,
				'note' => 'Admin Bot',
				'ammount' => $ammount,
				'type' => 'TRANSFER',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()]);

    	DB::table('salespaymentverifs')
    		->insert(['salesID' => $id,
        		'paymentID' => $newid,
        		'note' => 'Admin Bot',
        		'employeeID' => $empID,
        		'veriftime' => Carbon::now(),
        		'created_at' => Carbon::now(),
        		'updated_at' => Carbon::now()]);

    	//check
    	$check = Salespayment::leftjoin('salespaymentverifs', 
					function($join){
						$join->on('salespayments.id', '=', 'paymentID');
						/*$join->on('salespayments.salesID', '=', 'salespaymentverifs.salesID');*/
					}
				)
    			->where('salespayments.salesID', '=', $id)
    			->where('paymentID', '=', $newid)
    			->where('veriftime', '<>', null)
    			->get();

    	if(count($check) == 1)
    	{
    		return 'success';
    	}

    	return 'failed';
    }
}
