<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartfile;

class CartfileAPI extends Controller
{
  public function getFileByCartID($cartID)
	{
		$custID = session()->get('userid');
		$cartfiles = null;
		if($custID != null)
			$cartfiles = Cartfile::with('file')
					->with('cartheader')
					->whereHas('cartheader', function($query) use($custID){
						$query->where('customerID', '=', $custID);
					})
					->where('cartID', '=', $cartID)
					->get();
		return $cartfiles;
	}

	public function getFileByCustomerID($custID)
	{
		//YANG PAKE ADMIN
		$cartfiles = Cartfile::with('file')
					->with('cartheader')
					->whereHas('cartheader', function($query) use($custID){
						$query->where('customerID', '=', $custID);
					})
					->get();

		return $cartfiles;
	}

	public function create(Request $request)
	{
		$data = $request->all();

		if($data == null) return null;

		$cartfile = new Cartfile();
		$cartfile->cartID = $data['cartID'];
		$cartfile->fileID = $data['fileID'];
		$cartfile->save();

		return $this->getFileByCartID($data['cartID']);
	}

	public function apiGetAll(){
		$files = Cartfile::all();
		return $files;
	}

	public function deleteCartfileByID($id){
		$cartfile = Cartfile::with('file')
						->where('id', '=', $id)
						->first();

		$cartID = $cartfile->cartID;

		//return public_path();
		//remove dulu pathnya

		//FILE DAN ROW FILE TIDAK DI DELETE
		//KARENA MASI BISA DI PILIH LAGI DI MENU ADD

		/*$success = unlink(public_path($cartfile->file->path));
		
		if($success)
			$success = unlink(public_path($cartfile->file->preview));*/

		$cartfile->delete();

		return $this->getFileByCartID($cartID);
	}
}
