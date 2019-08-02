<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Onesignal;
use App\Employee;
use App\Customer;

class AdmOnesignalController extends Controller
{	
	public function index(){
		$onesignals = Onesignal::with('customeronesignal')
				->with('employeeonesignal')
				->get();

		$employees = Employee::with('role')
				->get();

		$customers = Customer::with('company')
				->get();

		return view('pages.admin.master.onesignal.index', compact('onesignals', 'employees', 'customers'));
	}
}
