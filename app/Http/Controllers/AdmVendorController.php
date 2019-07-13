<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;

class AdmVendorController extends Controller
{
	public function master(){
		$vendors = Vendor::with('address')
				->orderBy('salestype')
				->get();

		return view('pages.admin.master.vendor.index', compact('vendors'));
	}
}
