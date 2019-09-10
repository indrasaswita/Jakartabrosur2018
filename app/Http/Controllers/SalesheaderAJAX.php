<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesheader;

class SalesheaderAJAX extends Controller
{
	public function getBySalesID($salesid){


		$data = Salesheader::with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->where('id', $salesid)
				->orderBy('id', 'desc')
				->get(); 
		return $data;
	}
}
