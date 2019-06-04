<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobtype;
use App\Jobsubtype;
use App\Http\Requests;

class JobsubtypeController extends Controller
{
	public function getactive_backup(){
		$jobsubtypes = Jobsubtype::join('jobtypes', 'jobtypes.id', '=', 'jobtypeID')
								->select('jobtypes.code as jobtypecode', 'jobtypes.shortname as jobtypeshort', 'jobtypes.name as jobtypename', 'jobsubtypes.*')
								->orderBy('jobtypes.id', 'ASC')
								->get();
		return $jobsubtypes;
	}  
}
