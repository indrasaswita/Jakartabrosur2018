<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtype;
use App\Jobtype;

class JobsubtypeAPI extends Controller
{
	public function showbylink($pages){

		$datas = Jobsubtype::where('link', '=', $pages)
				->with('jobsubtypepapershop')
				->with('jobsubtypesize')
				->with('jobsubtypequantity')
				->with('jobsubtypefinishingshop')
				->with('jobsubtypedetailshop')
				->with('printeroffset')
				->with('printerdigital')
				->with('jobsubtypetemplate')
				->first();
		return $datas;
	}
		

	public function getActive(){
		$jobtypes = Jobsubtype::leftjoin('jobtypes', 'jobtypes.id', '=', 'jobtypeID')
								->where('active', '=', 1)
								->select('jobtypes.*')
								->distinct()
								->orderBy('jobtypes.id', 'ASC')
								->get();
		foreach ($jobtypes as $i => $jobtype) {
			$subtype = Jobsubtype::where('jobtypeID', '=', $jobtype['id'])
									->where('active', '=', 1)
									->orderBy('name', 'ASC')
									->get();
			$jobtype['jobsubtype'] = $subtype;
		}
		return $jobtypes;
	}

	public function getAll(){
		$jobtypes = Jobtype::with(['jobsubtype' => function ($query) {
			$query->orderBy('active', 'desc');
		}])
				->get();
		return $jobtypes;
	}
}
