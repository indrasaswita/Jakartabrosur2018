<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobsubtype;
use App\Jobtype;

class AdmJobeditorController extends Controller
{
	public function index(){
		$jobsubtypes = Jobsubtype::all();

		return view('pages.admin.master.jobs.editor', compact('jobsubtypes'));
	}

	public function activationjob(){
		$jobtypes = Jobtype::with('jobsubtype')
				->get();

		return view('pages.admin.master.jobs.activation', compact('jobtypes'));
	}

	public function jobfinishings(){
		$jobtypes = Jobtype::with(array('jobsubtype'=>function($query){
				$query->orderBy('name', 'ASC');
		}))
				->get();

		return view('pages.admin.master.jobs.finishings', compact('jobtypes'));
	}

	public function jobsizes(){
		$jobtypes = Jobtype::with(array('jobsubtype'=>function($query){
				$query->orderBy('name', 'ASC');
		}))
				->get();

		return view('pages.admin.master.jobs.sizes', compact('jobtypes'));
	}

	public function jobpapers(){
		$jobtypes = Jobtype::with(array('jobsubtype'=>function($query){
				$query->orderBy('name', 'ASC');
		}))
				->get();

		return view('pages.admin.master.jobs.papers', compact('jobtypes'));
	}

	public function jobquantities(){
		$jobtypes = Jobtype::with(array('jobsubtype'=>function($query){
				$query->orderBy('name', 'ASC');
		}))
				->get();

		return view('pages.admin.master.jobs.quantities', compact('jobtypes'));
	}
}
