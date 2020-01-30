<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesheader;
use App\Salesdetail;
use App\Salespayment;
use App\Cartheader;
use App\Cartdetail;

class AdmSalesheaderAJAX extends Controller
{
	public function delete($id){
		$salesheader = Salesheader::find($id);
		if($salesheader != null){

			$salesheaderID = $salesheader['id'];
			$cartheaders = Cartheader::whereIn('id', function($q) use ($salesheaderID){
						$q->from("salesdetails")
								->select("cartID")
								->where("salesID", function($q2) use ($salesheaderID){
											$q2->from("salesheaders")
													->select("id")
													->where('id', $salesheaderID);
										});
					})
					->get();

			foreach ($cartheaders as $i => $ii) {
				$ii->delete();
			}

			$result = $salesheader->delete();

			if($result)
				return [1, "success"];
		}

		return [0, "failed"];
	}
}
