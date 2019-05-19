<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtype;
use Carbon\Carbon;
use DB;

class AdmJobeditorAJAX extends Controller
{
	public function updatejobsubtype(Request $request){
		$data = $request->all();

		$jobsubtype = Jobsubtype::findOrFail($data['id']);
		if($jobsubtype!=null){
			unset($data['editmode']);
			unset($data['saveerror']);
			DB::table('jobsubtypes')
					->where('id', $data['id'])
					->update($data);
		}

		$newjobsubtype = Jobsubtype::findOrFail($data['id']);

		return $newjobsubtype;
	}

	public function activatejobsubtype($id, Request $request){

		$state = $request->all()[0];
		//$state -> active = 1
		//$state -> inactive = 0

		$result = Jobsubtype::find($id);
		if($result==null)
			return "Job not found in DB";
		else{
			if($result->active != $state){
				return "Status aktif salah, terjadi kesalahan pengambilan data";
			}else{
				$result->active = $state==0?1:0;
				$result->save();
				return "success";
			}
		}
	}
}
