<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesheader;
use App\Salesdetail;
use App\Http\Requests;
use App\Salespayment;
use App\Salespaymentverif;
use DB;
use Carbon\Carbon;
use App\Logic\Stat\AllSalesFilter;

class AllSalesCustomerView extends Controller
{
	public function indexempty(){
		return $this->index('');
	}

	public function index($link)
	{
		//SAMA PERSIS DENGAN AllSalesCustomerAPI@filterorder

		$customerID = session()->get('userid');

		if($link == ""){
			$allsales = AllSalesFilter::semua($customerID);
		}else if($link == "semua"){
			$allsales = AllSalesFilter::semua($customerID);
		}else if($link == "belumbayar"){
			$allsales = AllSalesFilter::belumbayar($customerID);
		}else if($link == "diproses"){
			$allsales = AllSalesFilter::diproses($customerID);
		}else if($link == "dikirim"){
			$allsales = AllSalesFilter::dikirim($customerID);
		}else if($link == "selesai"){
			$allsales = AllSalesFilter::selesai($customerID);
		}


		$current = Carbon::now();

		foreach ($allsales as $i => $header) {

			if($header['salesdetail']!=null)
			{
				$header['salesdetail']->each(function($jj, $j){
					$jj->makeVisible(['updated_at']);
				});

				foreach ($header['salesdetail'] as $j => $detail) {
					$header['salesdetail'][$j]['pip'] = Carbon::parse($detail['updated_at'])->diffForHumans($current);
				}
			}
		}       
				
		return view('pages.order.sales.index', compact('allsales', 'link'));
	}
}
