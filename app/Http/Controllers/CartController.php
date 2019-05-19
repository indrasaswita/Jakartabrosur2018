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

class CartController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$carts = $this->queryGetCart();
		return view('pages.order.cart.index', compact('carts'));
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
				->with('jobsubtype')
				->where('customerID', '=', $customer)
				->where('filestatus', '>', -2) //-2 deleted -1 itu file rejected
				->whereNotIn('id', function($query){
						$query->from('salesdetails')
							->select('cartID');
					})
				->get();

		return $carts;
	}

	public function cartDelete(Request $request){
		$id = $request->get(0);

		// HARUS CHILDNYA DULUAN
		$files = Cartfile::where('cartID', '=', $id)
						->get();
		foreach ($files as $item) {
			$item->delete();
			File::delete($item['path']);
			File::delete($item['icon']);
			File::delete($item['preview']);
		}

		$cart = Cartdetail::findOrFail($id);
		$cart->delete();

		foreach ($files as $item) {
			$item->delete();
		}

		$carts = $this->queryGetCart(0);
		return $carts;
	}

	public function createHeader(Request $request){
		$selected = $request->all();
		if ($selected == null) return null;
		$customerID = session()->get('userid');

		$header = new Salesheader();
		$header->customerID = $customerID;
		$header->tempo = Carbon::now();
		$header->estdate = Carbon::now();

		$customer = Customer::where('id', $customerID)
		        ->with('company')
		        ->first();
		//kalo customernya ga ketemu = hack
		if($customer!=null){
		    if($customer['company']['id']!=null){
		        $header->companyname = $customer['company']['name'];
		    }else{
		        $header->companyname = '';
		    }
	        $header->save();
		}

		$headerID = Salesheader::latest()
					->limit(1)
					->select('id')
					->get()[0]['id'];
		for($i=0;$i<count($selected);$i++)
		{
			$detail = new Salesdetail();
			$detail->salesID = $headerID;
			$detail->cartID = $selected[$i]['id'];
			$detail->prioritylevel = 2;
			$detail->statusfile = 1;
			$detail->statusctp = 0;
			$detail->statusprint = 0;
			$detail->statuspacking = 0;
			$detail->statusdelivery = 0;
			$detail->statusdone = 0;
			$detail->save();
		}
		return $headerID;
	}

	

	
}
