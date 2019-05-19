<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pricetext;

class AdmPricetextController extends Controller
{
	public function index(){
		$pricetexts = Pricetext::with('customer')
				->with('employee')
				->get();

		return view('pages.admin.master.pricetext.index', compact('pricetexts'));
	}
}
