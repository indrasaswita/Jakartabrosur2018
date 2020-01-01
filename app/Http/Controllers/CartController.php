<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartdetail;
use App\Cartfile;
use App\Http\Requests;
use File;
use App\Salesheader;
use App\Salesdetail;
use App\Cartdetailfinishing;
use Carbon\Carbon;
use App\Cartheader;
use App\Customer;
use App\Delivery;
use App\Customeraddress;

class CartController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$userid = session()->get('userid');

		$carts = $this->queryGetCart();
		$deliveries = Delivery::orderBy('price', 'ASC')
									->get();
		$custaddresses = Customeraddress::where('customerID', $userid)
				->with('address')
				->get();
		return view('pages.order.cart.index', compact('carts', 'deliveries', 'custaddresses'));
	}

	public function setToDeleted(Request $request)
	{
		//return "success";
		$id = $request->get("id");
		Cartdetail::where('id', '=', $id)
			->where('filestatus', '=', 0)
			->update(['filestatus'=>-2]);

		$cart = Cartdetail::find($id);
		if($cart->filestatus==-2)
			return "success";
		return "failed";
	}

	public function queryGetCart(){
		$customer = session()->get('userid');

		$carts = Cartheader::with('cartdetail')
				->with('cartfile')
				->with('delivery')
				->with('customer')
				->with('jobsubtype')
				->with('deliveryaddress')
				->where('customerID', '=', $customer)
				->where('filestatus', '>', -2) //-2 deleted -1 itu file rejected
				->whereNotIn('id', function($query){
						$query->from('salesdetails')
							->select('cartID');
					})
				->get();

		return $carts;
	}

	

	

	

	
}
