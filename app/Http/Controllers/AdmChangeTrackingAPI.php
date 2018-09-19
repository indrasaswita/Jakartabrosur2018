<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesdetail;
use App\Http\Requests;
use DB;
use Carbon\Carbon;

class AdmChangeTrackingAPI extends Controller
{
	public function changeStatusFile(Request $request)
	{
		$salesID = $request['salesID'];
		$cartID = $request['cartID'];

		$salesdetail = Salesdetail::where('salesID', '=', $salesID)
				->where('cartID', '=', $cartID)
				->first();

		if($salesdetail!=null)
		{
			$value = $salesdetail->statusfile==0 ? 1 : 0;
			if($value == 1)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusfile'=>1,
										'updated_at'=>Carbon::now()]);
			else if($value == 0)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusfile'=>0,
										'statusctp'=>0,
										'statusprint'=>0,
										'statuspacking'=>0,
										'statusdelivery'=>0,
										'statusdone'=>0,
										'updated_at'=>Carbon::now()]);

			return $value;
		}

		return "error";
	}

	public function changeStatusCTP(Request $request)
	{
		$salesID = $request['salesID'];
		$cartID = $request['cartID'];

		$salesdetail = Salesdetail::where('salesID', '=', $salesID)
				->where('cartID', '=', $cartID)
				->first();

		if($salesdetail!=null)
		{
			$value = $salesdetail->statusctp==0 ? 1 : 0;
			if($value == 1)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusfile'=>1,
										'statusctp'=>1,
										'updated_at'=>Carbon::now()]);
			else if($value == 0)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusctp'=>0,
										'statusprint'=>0,
										'statuspacking'=>0,
										'statusdelivery'=>0,
										'statusdone'=>0,
										'updated_at'=>Carbon::now()]);

			return $value;
		}

		return "error";
	}

	public function changeStatusPrint(Request $request)
	{
		$salesID = $request['salesID'];
		$cartID = $request['cartID'];

		$salesdetail = Salesdetail::where('salesID', '=', $salesID)
				->where('cartID', '=', $cartID)
				->first();

		if($salesdetail!=null)
		{
			$value = $salesdetail->statusprint==0 ? 1 : 0;
			if($value == 1)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusfile'=>1,
										'statusctp'=>1,
										'statusprint'=>1,
										'updated_at'=>Carbon::now()]);
			else if($value == 0)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusprint'=>0,
										'statuspacking'=>0,
										'statusdelivery'=>0,
										'statusdone'=>0,
										'updated_at'=>Carbon::now()]);

			return $value;
		}

		return "error";
	}

	public function changeStatusPacking(Request $request)
	{
		$salesID = $request['salesID'];
		$cartID = $request['cartID'];

		$salesdetail = Salesdetail::where('salesID', '=', $salesID)
				->where('cartID', '=', $cartID)
				->first();

		if($salesdetail!=null)
		{
			$value = $salesdetail->statuspacking==0 ? 1 : 0;
			if($value == 1)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusfile'=>1,
										'statusctp'=>1,
										'statusprint'=>1,
										'statuspacking'=>1,
										'updated_at'=>Carbon::now()]);
			else if($value == 0)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statuspacking'=>0,
										'statusdelivery'=>0,
										'statusdone'=>0,
										'updated_at'=>Carbon::now()]);

			return $value;
		}

		return "error";
	}

	public function changeStatusDelivery(Request $request)
	{
		$salesID = $request['salesID'];
		$cartID = $request['cartID'];

		$salesdetail = Salesdetail::where('salesID', '=', $salesID)
				->where('cartID', '=', $cartID)
				->first();

		if($salesdetail!=null)
		{
			$value = $salesdetail->statusdelivery==0 ? 1 : 0;
			if($value == 1)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusfile'=>1,
										'statusctp'=>1,
										'statusprint'=>1,
										'statuspacking'=>1,
										'statusdelivery'=>1,
										'updated_at'=>Carbon::now()]);
			else if($value == 0)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusdelivery'=>0,
										'statusdone'=>0,
										'updated_at'=>Carbon::now()]);

			return $value;
		}

		return "error";
	}

	public function changeStatusDone(Request $request)
	{
		$salesID = $request['salesID'];
		$cartID = $request['cartID'];

		$salesdetail = Salesdetail::where('salesID', '=', $salesID)
				->where('cartID', '=', $cartID)
				->first();

		if($salesdetail!=null)
		{
			$value = $salesdetail->statusdone==0 ? 1 : 0;
			if($value == 1)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusfile'=>1,
										'statusctp'=>1,
										'statusprint'=>1,
										'statuspacking'=>1,
										'statusdelivery'=>1,
										'statusdone'=>1,
										'updated_at'=>Carbon::now()]);
			else if($value == 0)
				DB::table('salesdetails')
					->where('salesID', '=', $salesID)
					->where('cartID', '=', $cartID)
					->update(['statusdone'=>0,
										'updated_at'=>Carbon::now()]);

			return $value;
		}

		return "error";
	}
}
