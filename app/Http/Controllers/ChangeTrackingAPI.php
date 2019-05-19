<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Salesdetail;

class ChangeTrackingAPI extends Controller
{
  public function changeStatusDone(){
  	$salesID = $request['salesID'];
		$cartdetailID = $request['cartdetailID'];

		$salesdetail = Salesdetail::where('salesID', '=', $salesID)
				->where('cartdetailID', '=', $cartdetailID)
				->first();

		$customerID = $salesdetail->header['customerID'];
		dd($customerID);

			if(count($salesdetail)==1)
			{
				$value = $salesdetail->statusdone==0 ? 1 : 0;
				if($value == 1)
					DB::table('salesdetails')
						->where('salesID', '=', $salesID)
						->where('cartdetailID', '=', $cartdetailID)
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
						->where('cartdetailID', '=', $cartdetailID)
						->update(['statusdone'=>0,
											'updated_at'=>Carbon::now()]);

				return $value;
			}

		return "error";
  }
}
