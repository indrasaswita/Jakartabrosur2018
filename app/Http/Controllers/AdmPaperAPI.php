<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paperdetail;
use DB;
use Carbon\Carbon;

class AdmPaperAPI extends Controller
{
	public function updateManyRows(Request $request)
	{

		$datas = $request->all();
		$updated_count = 0;

		foreach ($datas as $i => $data) {
			$temp = Paperdetail::where('paperID', '=', $data['paperID'])
					->where('vendorID', '=', $data['vendorID'])
					->where('planoID', '=', $data['planoID'])
					->first();

			//return ($temp==null?'tets':'tis');

			//KALO GA KETEMU BRARTI $temp == null
			if($temp == null){
				//INSERT
				$baru = new Paperdetail();

				$baru->paperID = $data['paperID'];
				$baru->vendorID = $data['vendorID'];
				$baru->planoID = $data['planoID'];

				$baru->buyprice = $data['newpricebuy'];
				$baru->sellprice = $data['newpricesell'];
				$baru->unitprice = $data['newpriceunit'];

				$baru->unittype = $data['unittype'];
				$baru->totalpcs = $data['totalpcs'];
				$baru->available = 1;
				
				$baru->save();

			}else{
				//UPDATE
				DB::table('paperdetails')
					->where('paperID', '=', $data['paperID'])
					->where('vendorID', '=', $data['vendorID'])
					->where('planoID', '=', $data['planoID'])
					->update([
							"buyprice" => round(floatval($data['newpricebuy']), 0),
							"sellprice" => round(floatval($data['newpricesell']), 0),
							"unitprice" => round(floatval($data['newpriceunit']), 2),
							"updated_at" => Carbon::now()
						]);
			}

			$result = Paperdetail::where('paperID', '=', $data['paperID'])
				->where('vendorID', '=', $data['vendorID'])
				->where('planoID', '=', $data['planoID'])
				->where('buyprice', '=', round(floatval($data['newpricebuy']), 0))
				->where('sellprice', '=', round(floatval($data['newpricesell']), 0))
				->where('unitprice', '=', round(floatval($data['newpriceunit']), 2))
				->get();


			if(count($result) > 0)
				$updated_count ++;
			else
				echo "er[".$i."]:".$data['newpricebuy']." - ".$data['newpricesell']." - ".$data['newpriceunit']."<br>";
		}

		if($updated_count == count($datas))
			return "success";
		else
			return "error: ".$updated_count;
	}
}
