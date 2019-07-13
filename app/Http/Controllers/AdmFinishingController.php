<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Finishing;

class AdmFinishingController extends Controller
{
	public function master(){
		$finishings = Finishing::with('finishingoption')
				->get();;


		return view('pages.admin.master.finishing.index', compact('finishings'));
	}
}
