<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cartheader;
use App\Cartdetail;
use Carbon\Carbon;

class AdmCartAPI extends Controller
{
	public function getAll(){
		$datas = Cartheader::with('cartdetail')
				->with('customer')
				->with('jobsubtype')
				->orderBy('id', 'desc')
				->get();

		return $datas;
	}

	public function getCartOnly(){
		$datas = Cartheader::with('cartdetail')
				->with('customer')
				->with('jobsubtype')
				->doesntHave('salesdetail')
				->orderBy('id', 'desc')
				->get();

		return $datas;
	}

	public function updateEmployeeNote(Request $request)
	{
		$data = $request->all();
		$id = $data['cartdetailID'];
		$employeenote = $data['employeenote'];

		$cartdetail = Cartdetail::findOrFail($id);
		$cartdetail->employeenote = $employeenote;
		$cartdetail->save();

		$cartdetail = Cartdetail::findOrFail($id);
		return $cartdetail->employeenote;
	}

	public function deleteCart($id){
		$header = Cartheader::findOrFail($id);
		$header->delete();
		if($header != null)
		{
			$details = Cartdetail::where('cartID', '=', $id)->get();
			foreach ($details as $d => $detail) {
				$detail->delete();
			}
		}
		return "deleted";
	}

	public function addNewCart(Request $request){
		$data = $request->all();

		$deadline = Carbon::parse($data['deadline']);
		$deadline->setTime(0, 0, 0);
		$nw = Carbon::now();
		$nw->setTime(0, 0, 0);
		$delivery = Carbon::parse($data['deliverytime']);
		$delivery->setTime(0, 0, 0);

		$deliverytime = $delivery->diffInDays($nw);
		$processtime = $deadline->diffInDays($nw);

		//HEADER
		$header = new Cartheader();
		$header->customerID = $data['customerID'];
		$header->jobsubtypeID = $data['jobsubtype']['id'];
		$header->jobtitle = $data['jobtitle'];
		$header->quantity = $data['quantity'];
		$header->quantitytypename = $data['quantitytypename'];
		$header->customernote = '';//$data[''];
		$header->itemdescription = $data['itemdescription'];
		$header->resellername = $data['reseller'];
		$header->resellerphone = $data['resellerphone'];
		$header->reselleraddress = $data['reselleraddress'];
		$header->buyprice = $data['buyprice'];
		$header->printprice = $data['printprice'];
		$header->deliveryprice = $data['deliveryprice'];
		$header->discount = $data['discount'];
		$header->processtype = $data['processtype'];
		$header->processtime = $processtime; // dari deadline (jangan lupa di diff)
		$header->deliveryID = $data['delivery']['id'];
		$header->deliveryaddress = $data['deliveryaddress'];
		$header->deliverytime = $deliverytime;
		$header->totalpackage = $data['totalpackage'];
		$header->totalweight = $data['totalweight'];
		$header->filestatus = 0;//$data[''];

		$header->save();

		$cartID = Cartheader::select("id")
					->orderBy('id', 'desc')
					->first();
					
		if($cartID == null)
			return null;
		else
			$cartID = $cartID['id'];

		foreach ($data['cartdetails'] as $i => $detail) {
			$cartdetail = new Cartdetail();
			$cartdetail->cartID = $cartID;
			$cartdetail->cartname = $detail['cartname'];
			$cartdetail->jobtype = $detail['jobtype'];
			$cartdetail->printerID = $detail['printerID'];
			$cartdetail->paperID = $detail['paper']['id'];
			$cartdetail->vendorID = $detail['vendor']['id'];
			$cartdetail->planoID = $detail['planosize']['id'];
			$cartdetail->printwidth = $detail['printwidth'];
			$cartdetail->printlength = $detail['printlength'];
			$cartdetail->imagewidth = $detail['imagewidth'];
			$cartdetail->imagelength = $detail['imagelength'];
			$cartdetail->side1 = $detail['side1'];
			$cartdetail->side2 = $detail['side2'];
			$cartdetail->employeenote = $detail['employeenote'];
			$cartdetail->totaldruct = $detail['totaldruct'];
			$cartdetail->inschiet = $detail['inschiet'];
			$cartdetail->totalplano = $detail['totalplano'];
			$cartdetail->totalinplanox = $detail['totalinplanox'];
			$cartdetail->totalinplanoy = $detail['totalinplanoy'];
			$cartdetail->totalinplanorest = $detail['totalinplanorest'];
			$cartdetail->totalinplano = $detail['totalinplano'];
			$cartdetail->totalinprintx = $detail['totalinprintx'];
			$cartdetail->totalinprinty = $detail['totalinprinty'];
			$cartdetail->totalinprintrest = $detail['totalinprintrest'];
			$cartdetail->totalinprint = $detail['totalinprint'];
			$cartdetail->totalpaperprice = $detail['paperprice'];

			$cartdetail->save();
		}

		return "success";
	}
}
