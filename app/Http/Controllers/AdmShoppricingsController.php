<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constant;
use App\Finishing;

class AdmShoppricingsController extends Controller
{
	public function index(){
		$constants = Constant::all();
		$finishings = Finishing::with('finishingoption')
				->get();

		return view('pages.admin.master.shoppricings.index', compact('constants', 'finishings'));
	}
}
