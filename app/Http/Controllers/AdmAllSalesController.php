<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Salesheader;
use App\Delivery;
use App\Employee;
use App\Customer;
use App\Http\Requests;
use App\Logic\Curl\Klikbca;

use DB;
use Carbon\Carbon;

class AdmAllSalesController extends Controller
{
	public function __construct()
	{
		$this->middleware('employee');
	}
	public function index()
	{
		$headers = Salesheader::orderBy("salesheaders.id", 'desc')
				->with('customer')
				->with('salesdetail')
				->with('salespayment')
				->with('salesdelivery')
				->get();

		$current = Carbon::now();

		// UNTUK MUNCULIN Created_at YANG HIDDEN
		foreach ($headers as $i => $header) {
			if($header['salesdelivery']!=null)
				$header['salesdelivery'] = $header['salesdelivery']->makeVisible('created_at')->toArray();

			if($header['salesdetail']!=null)
			{
				foreach ($header['salesdetail'] as $j => $detail) {
					$header['salesdetail'][$j]['pip'] = Carbon::parse($detail['updated_at'])->diffInDays($current);
				}
			}
		}
		

		$deliveries = Delivery::all();

		$couriers = Employee::join('roles', 'roles.id', '=', 'roleID')
				->select('roles.name as rolename', 'employees.*')
				->where('roles.name', '=', 'Courier')
				->get();
				
		return view('pages.admin.sales.index', compact('headers', 'deliveries', 'couriers'));
	}
}

