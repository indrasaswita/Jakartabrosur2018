<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customeraddress;
use App\Address;
use DB;

class CustomeraddressAJAX extends Controller
{
	public function store(Request $request, $custid){
		$datas = $request->all();
		if($datas!=null){
			$add = new Address();
			$add->name = $datas['name'];
			$add->address = $datas['location'];
			$add->addressnotes = $datas['note'];
			$add->cityID = $datas['city']['id'];
			$add->save();

			$lastadd = Address::orderBy('id', 'DESC')
					->first();
			if($lastadd != null)
			{
				$custadd = new Customeraddress();
				$custadd->customerID = $custid;
				$custadd->addressID = $lastadd['id'];
				$custadd->save();

				$addresses = $this->bycustid($custid);
				return $addresses;
			}else{
				//ga ada data addressnya
				return null;
			}
		}else{
			return null;
		}
	}
	
  public function editaddress(Request $request, $id){
		$data = $request->all();
		$addresses = Address::findOrFail($id);
		if($addresses != null)
		{
			DB::table('addresses')->where('id','=',$id)
			->update([
					'name' => $data['name'],
					'address' => $data['address'],
					'addressnotes' => $data['addressnotes'],
					'cityID' => $data['city']['id']
			]);
			$status = 'success';
			return $status;
		}
		else
		{
			$status = 'error';
			return status;
		}
	}

	public function bycustid($custid){
		$addresses = Customeraddress::with('customer', 'address')
				->where('customerID', $custid)
				->orderBy('id', 'asc')
				->get();

		return $addresses;
	}
}
