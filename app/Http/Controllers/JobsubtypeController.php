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

  public function getactive(){
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
			$jobtype['subtypes'] = $subtype;
		}
  	return $jobtypes;
  } 
}
