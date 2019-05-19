<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cartheader;

class CartheaderAPI extends Controller
{

	public function apiFileStatusSetOk($id){
		DB::table('cartheaders')->where('id', '=', $id)
								->update(
									[
										"filestatus" => 1
									]
								);
		return ["data"=>$this->apiGetAll(), "status"=>"success"];
	}

	public function apiFileStatusSetNotOk($id){
		DB::table('cartheaders')->where('id', '=', $id)
								->update(
									[
										"filestatus" => 0
									]
								);
		return ["data"=>$this->apiGetAll(), "status"=>"success"];
	}

	public function apiGetAll(){
		//sama dengan di AdmCartController
		$cartheaders = Cartheader::with('customer')
				->with('jobsubtype')
				->with('cartfile')
				->with('cartdetail')
				->with('delivery')
				->whereNotIn('id', function($query){
					$query->select('cartID')->from('salesdetails');
				})
				->orderBy('id', 'desc')
				->get();

		return $cartheaders;
	}
}
