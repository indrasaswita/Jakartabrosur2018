<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesdetail;
use Carbon\Carbon;

class AllaccCartheaderController extends Controller
{
	public function show($salesdetailid){
		$userid = session()->get('userid');
		if($userid == null)
			return abort(403);

		//SLEECTNYA DARI SALESDETAILNYA bukan dari cartnya
		$salesdetail = Salesdetail::with("cartheader")
				->with("salesheader")
				->where('id', $salesdetailid)
				->whereHas("salesheader", function($q2) use ($userid){
					$q2->where('customerID', $userid);
				})
				->first();

		$current = Carbon::now();
		$salesdetail['pip'] = Carbon::parse($salesdetail['updated_at'])->diffForHumans($current);

		if($salesdetail != null){
			return view("pages.allaccess.sales.cartheader", compact('salesdetail'));
		} else {
			return abort(404);
		}
	}
}
