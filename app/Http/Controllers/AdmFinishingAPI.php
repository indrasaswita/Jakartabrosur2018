<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Finishing;
use App\Jobsubtypefinishing;
use App\Jobsubtype;

class AdmFinishingAPI extends Controller
{
 public function getFinishing(){
		$finishing = Finishing::where('status', '=', '1')
		->get();
		return $finishing;
	}

	public function getDetailFinishing($id){
		$jobsubtypefinishing = Jobsubtypefinishing::where('finishingID', '=', $id)
		->with(['jobsubtype' => function($query){
			$query->select('id','name');
		}])
		->select('jobsubtypeID')
		->get();

		$finishingoptions = Finishing::where('id', $id)
				->with(['finishingoption' => function($query){
					$query->select('finishingID', 'optionname');
				}])
				->select('id')
				->get();

		return [
				"jobsubtypes" => $jobsubtypefinishing, 
				"finishingoptions" => $finishingoptions
		];
	}
}
