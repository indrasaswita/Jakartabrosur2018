<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cartheader;
use App\Cartdetail;
use App\Jobsubtype;
use App\Printingmachine;
use App\Paper;
use App\Delivery;
use DB;

class AdmCartController extends Controller
{
	public function index()
	{
		//SAMA dengan di CartheaderAPI
		$carts = Cartheader::with('customer')
				->with('jobsubtype')
				->with('cartfile')
				->with('cartdetail')
				->with('delivery')
				->whereNotIn('id', function($query){
					$query->select('cartID')->from('salesdetails');
				})
				->orderBy('id', 'desc')
				->get();

		$jobsubtypes = Jobsubtype::select('id', 'name', 'subname', 'satuan')
				->get();

		$printers = Printingmachine::all();

		$papers = Paper::select('id', 'name', 'color', 'gramature')
				->get();				

		$deliveries = Delivery::select('id', 'deliverytype', 'deliveryname', 'baseprice', 'price', 'priceper', 'locked')
				->get();

				
		return view("pages.admin.cart.index", compact("carts", 'jobsubtypes', 'printers', 'papers', 'deliveries'));
	}

	public function joincart(){
		$carts = Cartheader::with('customer')
				->with('jobsubtype')
				->with('cartfile')
				->with('cartdetail')
				->with('delivery')
				->whereNotIn('id', function($query){
					$query->select('cartID')->from('salesdetails');
				})
				->orderBy('customerID', 'asc')
				->get();

		return view('pages.admin.cart.joincart', compact('carts'));
	}
}
