<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Paper;
use App\Jobsubtype;
use App\Jobtype;
use App\Jobsubtypequantity;
use App\Jobsubtypefinishing;
use App\Finishingoption;
use App\Size;
use App\Cartdetail;
use App\Cartheader;
use App\Cartdetailfinishing;
use App\Cartfile;
use App\Delivery;
use App\Customer;
use App\Notification;
use Crypt;
use App\Helpers\MathHelper;
use App\Logic\Curl\OneSignal;

class ShopController extends Controller
{
	public function showlists(){
		
		$datas = Jobtype::with(['jobsubtype' => function ($query) {
				$query->where('active', 1);
			}])
				->get();

		return view('pages.order.shop.lists', compact('datas'));

	}

	public function show($pages)
	{
		//YG LAMA
		$datas = Jobsubtype::where('link', '=', $pages)
				->with('jobsubtypepaper')
				->with('jobsubtypesize')
				->with('jobsubtypequantity')
				->with('jobsubtypefinishing')
				->with('jobsubtypedetail')
				->with('printeroffset')
				->with('printerdigital')
				->with('jobsubtypetemplate')
				->first();

		$custID = session()->get('userid');
		$customer = Customer::where('id', $custID)
				->with('customeraddress')
				->first();
		if($customer!=null)
			$datas['user'] = $customer;

		if(gettype($datas)=="object"){
			foreach ($datas['jobsubtypefinishing'] as $i => $ii) {
				foreach ($ii['finishing']['finishingoption'] as $j => $jj) {
					$jj->setHidden(['priceper', 'price', 'pricebase', 'priceminim']);	
				}
			} //HIDE FINISHING
		}else{
			return abort(404);
		}

		if(gettype($datas)=="object"){
			foreach ($datas['jobsubtypepaper'] as $i => $ii) {
				foreach ($ii['paper']['paperdetail'] as $j => $jj) {
					$jj->setHidden(['buyprice', 'sellprice', 'unitprice']);	
				}
			} // HIDE PAPER
		}else{
			return abort();
		}
		
		if($datas != null)
		{
			//die (htmlspecialchars($datas['infosize']));
			if(count($datas->toArray())==0)
			{
				//dibalikin ke shoplist
				return view('pages.order.shop.lists');
			}
			else
			{
				$deliveries = Delivery::orderBy('price', 'ASC')
									->get();
				$datas['deliveries'] = $deliveries;

				if($datas['jobsubtypedetail'] != null)
				{
					if(count($datas['jobsubtypedetail']->toArray())==0){
						//TIDAK ADA DETAIL JOBSUBTYPE
						return view('pages.order.shop.index', compact('datas'));
					}else{
						//KALO ADA DETAIL -> MASUK KE MULTIPLE
						return view('pages.order.shop.index', compact('datas', ''));
					}
				}
				else
				{
//die($datas['jobsubtypepapershop']);//['jobsubtypepapershop']);

					//TIDAK ADA DETAIL JOBSUBTYPE
					return view('pages.order.shop.index', compact('datas'));
				}
			}
		}else{
			return view('errors.503');
		}
	}


	public function updateCart(Request $request)
	{
		$userid = session()->get('userid');
		if($userid == null)
			return null;

		$data = $input['selected'];
		if(!array_key_exists('cartID', $data))
			return "wrongurl";
		$cartID = $data['cartID'];
		$test = Cartheader::where('id', $cartID)
				->where('customerID', $userid)
				->get();

		if(count($test)==0){
			return "wronguser";
		}else{
			return $this->storeCart($request);
		}
	}

	public function storeCart(Request $request)
	{
		$input = $request->all();


		$data = $input['selected'];
		$new = false;
		if(!array_key_exists('cartID', $data))
			$new = true;

		$key = Crypt::decrypt($input['key']);

		$calc = $key['calculation'];
		$paper = $key['paper'];
		$total = $key['total'];
		$input = $key['input'];

		$customerID = session()->get('userid');

		$header = null;
		if($new)
			$header = new Cartheader();
		else{
			$cartID = $data['cartID'];
			$header = Cartheader::where('id'	, $cartID)
					->with('cartdetail')
					->first();
		}
		if($header == null)
			return "noheaderfound";

		$header->customerID = $customerID;
		$header->jobsubtypeID = $data['jobsubtypeID']==null?"":$data['jobsubtypeID'];
		$header->jobtitle = $data['jobtitle']==null?"":$data['jobtitle'];

		$header->quantity = $data['quantity'];
		$header->quantitytypename = $data['satuan']==null?"":$data['satuan'];
		
		$header->customernote = $data['customernote']==null?"":$data['customernote'];
		$header->itemdescription = $data['itemdescription']==null?"":$data['itemdescription'];
		
		$header->resellername = $data['resellername']==null?"":$data['resellername'];
		$header->resellerphone = $data['resellerphone']==null?"":$data['resellerphone'];
		$header->reselleraddress = $data['reselleraddress']==null?"":$data['reselleraddress'];

		$header->buyprice = 0;

		$header->printprice = $total['price'];
		$header->deliveryprice = $total['deliv'];
		$header->discount = $total['disc'];

		$header->processtype = $data['processtime'];
		$header->processtime = $total['processday'];
		$header->deliveryID = $data['delivery']['id'];
		$header->deliveryaddressID = $data['deliveryaddress']==null?null:$data['deliveryaddress']['address']['id'];
		 // dd($data['deliveryaddress']['address']['id']);

		$header->deliverytime = $total['deliveryday'];
		
		$header->totalpackage = MathHelper::ceil($data['quantity']/$data['perbungkus'], 1);
		$header->totalweight = $total['weight'];
		$header->filestatus = 0; 

		//SAVE HEADER PINDAH KE BAWAH (BIAR KALO ADA ERROR DIA GA SAVE HEADERNYA DULU)

		if(!$new){
			if($header['cartdetail'] != null){
				foreach ($header['cartdetail'] as $d => $detail) {
					foreach ($detail['cartdetailfinishing'] as $f => $finishing) {
						$fin = Cartdetailfinishing::find($finishing['id']);
						$fin->delete();
					}
					$det = Cartdetail::find($detail['id']);
					$det->delete();
				}
			}
		}

		//BUAT DETAIL BARU UNTUK INDEX KE 0
		$detail = new Cartdetail();

		$detail->cartname = "Main";

		//detail->cartID = dimauskin belakangan kalo ga ada error (sebelom save)
		$detail->jobtype = $data['printtype'];
		$detail->printerID = $data['printerID'];

		$detail->paperID = $paper['paperID'];
		$detail->vendorID = $paper['vendorID'];
		$detail->planoID = $paper['planoID'];
		
		$detail->printwidth = $calc['printwidth'];
		$detail->printlength = $calc['printlength'];
		$detail->imagewidth = $input['imagewidth'];
		$detail->imagelength = $input['imagelength'];

		$detail->side1 = 4;
		$detail->side2 = $data['sideprint']=='2'?4:0;
		//--SEMENTARA SIDE dibuat 4/4 atau 4/0 dulu
		$detail->employeenote = '';
		
		$detail->totaldruct = $calc['totaldruct'];
		$detail->inschiet = $calc['inschiet'];
		$detail->totalplano = $paper['totalplano'];

		$detail->totalinplano = $calc['totalinplano'];
		$detail->totalinplanox = $calc['totalinplanox'];
		$detail->totalinplanoy = $calc['totalinplanoy'];
		$detail->totalinplanorest = $calc['totalinplanorest'];

		$detail->totalinprint = $calc['totalinprint'];
		$detail->totalinprintx = $calc['totalinprintx'];
		$detail->totalinprinty = $calc['totalinprinty'];
		$detail->totalinprintrest = 0;

		$detail->totalpaperprice = $calc['totalpaperprice'];
		//$detail->deliveryprice = $total['deliv'];

		if($new){
			$cartfiles = [];
			foreach ($data['files'] as $i => $file) {
				$temp = new Cartfile();
				$temp->fileID = $file['id'];
				array_push($cartfiles, $temp);
			}
		}


		$finishings = $key['finishings'];
		$cartdetailfinishings = [];
		//UNTUK yang detailny cuma 1, pakai idakhird
		//UNTUK yang detailnya banyak, pakaiin ARRAY (belum buat)
		foreach($finishings as $i => $finishing)
		{
			$detailfin = new Cartdetailfinishing;
			$detailfin->finishingID = $finishing['finishingID'];
			$detailfin->optionID = $finishing['optionID'];
			$detailfin->quantity = $calc['totaldruct'];
			$detailfin->buyprice = 0;
			$detailfin->sellprice = $finishing['totalprice'];
			$detailfin->side = 0; // belom di buat

			array_push($cartdetailfinishings, $detailfin);
		}

		///SAVVEEEEEEEEEE//
		///SAVVEEEEEEEEEE//
		///SAVVEEEEEEEEEE//
		///SAVVEEEEEEEEEE//
		///SAVVEEEEEEEEEE//

		// 1.
		// SAVE HEADER
		// ===============

		$result = $header->save();

		if($result == false)
			return "headercannotbesaved";

		$idakhirh = 0;
		if($new){
			//AFTER INSERT
			$stelahinsert = Cartheader::orderBy('id', 'desc')
					->select('id')
					->first();

			$idakhirh = $stelahinsert['id'];
		}else{
			$idakhirh = $header['id'];
		}

		// 2.
		// SAVE DETAIL
		// ===============

		$sblominsert = Cartdetail::orderBy('id', 'desc')
				->select('id')
				->first();

		if($sblominsert == null)
			$idawald = 0;
		else
			$idawald = $sblominsert['id'];

		$detail->cartID = $idakhirh; // BARU MASUKIN cartID
		$detail->save();

		//AFTER INSERT
		$stelahinsert = Cartdetail::orderBy('id', 'desc')
				->select('id')
				->first();

		if($stelahinsert == null)
			$idakhird = 0;
		else
			$idakhird = $stelahinsert['id'];

		if($idawald == $idakhird)
			return null; // kalo tidak ke store

		if($new){
			//cartfiles diisi ketika diatas
			foreach ($cartfiles as $i => $file) {
				$file->cartID = $idakhirh;
				$file->save();
			}
		}


		//cartdetailfinishings diisi diatas

		foreach ($cartdetailfinishings as $i => $fin) {
			$fin->cartdetailID = $idakhird;
			$fin->save();
		}

		/*Mail::send('index', ['datas'=>$data], function ($message)
	{
	  //$message->from('indrasaswita@gmail.com', 'Jakarta Brosur No-reply');
	  $message->to('rahayu_printing@yahoo.co.id')
		->subject('Cart Placed Reminder!');
	});*/


	$notif = new Notification();
	$notif->owner = 'EM';
	$notif->ownerID = null;
	$notif->icon = 'fas fa-puzzle-piece fa-fw tx-success';
	$notif->title = 'Order Baru!';
	$notif->content = '<b>New Order</b> JOB. ID: '.$idakhirh.'<br>Nama cust.: '.session()->get('name').'<br>Judul Cetakan: '.$data['quantity'].' '.$data['satuan'].' '.$data['jobtitle'].'<br>Proses: '.$total['processday'].'(kerja)+'.$total['deliveryday'].'(deliv.) hari';
	$notif->viewed = 0;
	$notif->save();


	$notif = new OneSignal();
	$result = $notif->sendMessage('New Order Placed!', 'NoJob. '.$idakhirh.', ['.$data['jobtitle'].'] total '.$data['quantity'].' '.$data['satuan'].'');


		return "success";
	}

	
}
