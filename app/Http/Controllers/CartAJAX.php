<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Cartfile;
use App\Cartdetail;
use App\Cartheader;
use App\Http\Controllers\CartController;

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

}
