<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Cartfile;
use App\Cartdetail;
use App\Cartheader;
use App\Salesdetail;
use App\Salesheader;
use App\Customer;
use App\Http\Controllers\CartController;
use Carbon\Carbon;

class CartAJAX extends Controller
{
	public function cartDelete(Request $request){
		$id = $request->get(0);
		//$id -> cartID

		// HARUS CHILDNYA DULUAN
		$files = Cartfile::where('cartID', '=', $id)
						->get();
		foreach ($files as $item) {
			$item->delete();
			File::delete($item['path']);
			File::delete($item['icon']);
			File::delete($item['preview']);
		}

		$details = Cartdetail::where("cartID", $id)->get();
		foreach ($details as $i => $ii) {
			$ii->delete();
		}

		foreach ($files as $item) {
			$item->delete();
		}

		$cart = Cartheader::findOrFail($id);
		$cart->delete();

		$cartCtrl = new CartController();
		$carts = $cartCtrl->queryGetCart();
		return $carts;
	}

	public function cartDuplicate(Request $request){
		$id = $request->get(0);

		$cart = Cartheader::findOrFail($id);
		$nw = $cart->replicate();
		$nw->jobtitle .= " Copy";
		$nw->save();
		$newid = Cartheader::orderBy('id', 'desc')
				->first()['id'];

		$details = Cartdetail::where("cartID", $id)->get();
		foreach ($details as $i => $ii) {
			$nw = $ii->replicate();
			$nw->cartID = $newid;
			$nw->save();
		}


		$cartCtrl = new CartController();
		$carts = $cartCtrl->queryGetCart();
		return $carts;
	}

	public function cartChangeTitle(Request $request){
		$id = $request->get(0);
		$newtitle = $request->get(1);

		$cart = Cartheader::findOrFail($id);
		$cart->jobtitle = $newtitle;
		$cart->save();


		$cartCtrl = new CartController();
		$carts = $cartCtrl->queryGetCart();
		return $carts;
	}

	public function cartCheck($cartID){
		//dd($cartID);
		$checksalesdetail = Salesdetail::where("cartID", $cartID)
			->get();
		if($checksalesdetail){
			$msg = "Data sudah masuk sales";
		}
		else{
			$checkcartheader = Cartheader::findOrFail($cartID);
			if($checkcartheader){
				$msg = "edit";
			}
			else{
				$msg = "new";
			}
		}	
		return $msg;
	}

	public function createHeader(Request $request){
		$selected = $request->all();
		if ($selected == null) return null;
		$customerID = session()->get('userid');

		$header = new Salesheader();
		$header->customerID = $customerID;
		$header->tempo = Carbon::now();
		$header->estdate = Carbon::now();
		$header->name = "No Title";

		$customer = Customer::where('id', $customerID)
				->with('company')
				->first();
		//kalo customernya ga ketemu = hack
		if($customer!=null){
			$result = $header->save();

			if($result){
				$headerID = Salesheader::latest('id')->first()['id'];
				$countdetail = 0;
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
					
					$result2 = $detail->save();
					if($result2)
						$countdetail++;
				}

				if($countdetail != count($selected)){
					$header = Salesheader::latest()->first();
					$header->delete();
					return null;
				}

				return $headerID;
			}
		}

		return null;		
	}

}
