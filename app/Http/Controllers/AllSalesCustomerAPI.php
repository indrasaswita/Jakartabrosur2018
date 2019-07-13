<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Salesdetail;
use App\Salesheader;
use App\Salespayment;
use App\Salespaymentverif;
use DB;
use Carbon\Carbon;

class AllSalesCustomerAPI extends Controller
{
	public function commit($id)
	{
		//harus buat cartID, jadi commitnya itu per cartdetailID dan salesID
		//diganti jadi id dari salesdetail aja cukup
		$customerID = session()->get('userid');
		$sales = Salesdetail::where('id', '=', $id)
							->with('salesheader')
							->select('salesID', 'cartID', 'commited')
							->first();

		if($sales==null)
			return "Empty salesdetail..";

		if($customerID ==
			$sales['salesheader']['customerID'])
		{
			//berarti ketemu
			//ubah data jadi commited
			DB::table('salesdetails')
					->where('salesID', '=', $sales['salesID'])
					->where('cartID', '=', $sales['cartID'])
					->update(['commited'=>1]);

			$sales = Salesdetail::where('cartID', '=', $sales['cartID'])
							->where('salesID', '=', $sales['salesID'])
							->select('salesID', 'cartID', 'commited')
							->first();
		}
		else
		{
			return "Not your authority..";
		}

		return "success";
	}

}
