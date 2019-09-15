<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Finishingoption;

class AdmShoppricingsAJAX extends Controller
{
	public function updatefinishing(Request $request){
		$datas = $request->all();

		if($datas!=null){
			$options = [];

			foreach ($datas['finishingoption'] as $i => $option) {
				$newarr = [
					'optionname'=>$option['optionname'],
					'info'=>$option['info'],
					'price'=>$option['price'],
					'pricebase'=>$option['pricebase'],
					'priceminim'=>$option['priceminim'],
					'priceper'=>$option['priceper'],
					'processdays'=>$option['processdays']
				];
				DB::table('finishingoptions')
						->where('finishingID', $option['finishingID'])
						->where('id', $option['id'])
						->update($newarr);
			}

			DB::table('finishings')
					->where('id', $datas['id'])
					->update([
						'info'=>$datas['info'],
						'name'=>$datas['name'],
						'shortname'=>$datas['shortname'],
						'side'=>$datas['side'],
						'status'=>$datas['status']
					]);

			return 'success';
		}

		return 'error';
	}
	public function updateconstant(Request $request){
		$datas = $request->all();

		if($datas != null){
			foreach ($datas as $i => $constant) {
				$id = $constant['id'];
				unset($constant['id']);
				unset($constant['created_at']);
				unset($constant['updated_at']);
				DB::table('constants')
						->where('id', $id)
						->update($constant);
			}
			return "success";
		}

		return 'error';
	}
	public function insertconstant(Request $request){
		$datas = $request->all();
		return $datas;
	}
}
