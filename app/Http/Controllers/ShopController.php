<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Paper;
use App\Jobsubtype;
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
use Crypt;
use App\Helpers\MathHelper;

class ShopController extends Controller
{
	public function index(){
		//YG BARU
		

		/*$custID = session()->get('userid');
		$customer = Customer::find($custID);
		if($customer!=null)
			$datas['user'] = $customer;

		//$datas->setHidden(['priceper', 'priceminim', 'price', 'pricebase', 'ofdg']);
		//dd($datas);
		if($datas != null)
		{
			//die (htmlspecialchars($datas['infosize']));
			if(count($datas->toArray())==0)
			{
				return view('pages.order.shop.lists');
			}
			else
			{
				$deliveries = Delivery::orderBy('price', 'ASC')
									->get();
				$datas['deliveries'] = $deliveries;

				if($datas['jobsubtypedetailshop'] != null)
				{
					if(count($datas['jobsubtypedetailshop']->toArray())==0){
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
					return view('pages.order.shop.create', compact('datas'));
				}
			}
		}
		else
		{
			return "$datas is null, from certain Jobsubtype";
		}*/

		$datas = Jobsubtype::all();

		return view('pages.order.shop.create', compact('datas'));

	}

	public function show($pages)
	{
		//YG LAMA
		$datas = Jobsubtype::where('link', '=', $pages)
							->with('jobsubtypepapershop')
							->with('jobsubtypesize')
							->with('jobsubtypequantity')
							->with('jobsubtypefinishingshop')
							->with('jobsubtypedetailshop')
							->with('printeroffset')
							->with('printerdigital')
							->with('jobsubtypetemplate')
							->first();

		$custID = session()->get('userid');
		$customer = Customer::find($custID);
		if($customer!=null)
			$datas['user'] = $customer;

		//$datas->setHidden(['priceper', 'priceminim', 'price', 'pricebase', 'ofdg']);
		//dd($datas);
		if($datas != null)
		{
			//die (htmlspecialchars($datas['infosize']));
			if(count($datas->toArray())==0)
			{
				return view('pages.order.shop.lists');
			}
			else
			{
				$deliveries = Delivery::orderBy('price', 'ASC')
									->get();
				$datas['deliveries'] = $deliveries;

				if($datas['jobsubtypedetailshop'] != null)
				{
					if(count($datas['jobsubtypedetailshop']->toArray())==0){
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
		}
		else
		{
			return "$datas is null, from certain Jobsubtype";
		}
	}

	public function storingData(Request $request)
	{
		$input = $request->all();

		$data = $input['selected'];
		$calc = Crypt::decrypt($input['calculation']);
		$total = $input['total'];

		$customerID = session()->get('userid');

		$header = new Cartheader();

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
		$header->deliveryaddress = $data['deliveryaddress']==null?"":$data['deliveryaddress'];
		$header->deliverytime = $total['deliveryday'];
		
		$header->totalpackage = MathHelper::ceil($data['quantity']/$data['perbungkus'], 1);
		$header->totalweight = $total['weight'];
		$header->filestatus = 0; 

		$header->save();


		//AMBIL DATA YANG TERAKHIR IDNYA DI PAKE BUAT DI CARTDETAIL BARU
		$header = Cartheader::orderBy('id', 'desc')
				->select('id')
				->first();

		$newid = $header['id'];
		

		//BUAT DETAIL BARU UNTUK INDEX KE 0
		$detail = new Cartdetail();

		$detail->cartID = $newid;
		$detail->cartname = "Main";

		$detail->jobtype = $data['printtype'];
		$detail->printerID = $data['printerID'];

		$detail->paperID = $calc['paperID'];
		$detail->vendorID = $calc['vendorID'];
		$detail->planoID = $calc['planoID'];
		
		$detail->printwidth = $calc['printwidth'];
		$detail->printlength = $calc['printlength'];
		$detail->imagewidth = $data['size']['width'];
		$detail->imagelength = $data['size']['length'];

		$detail->side1 = 4;
		$detail->side2 = $data['sideprint']=='2'?4:0;
		//--SEMENTARA SIDE dibuat 4/4 atau 4/0 dulu
		$detail->employeenote = '';
		
		$detail->totaldruct = $calc['totaldruct'];
		$detail->inschiet = $calc['inschiet'];
		$detail->totalplano = $calc['totalplano'];

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

		
		$detail->save();

		$latest = Cartheader::orderBy('id', 'desc')
							->select('id')
							->first();
		$lastheaderid = $latest['id'];

		foreach ($data['files'] as $i => $file) {
			$cartfile = new Cartfile();
			$cartfile->cartID = $lastheaderid;
			$cartfile->fileID = $file['id'];

			$cartfile->save();
		}

		$latest2 = Cartdetail::orderBy('id', 'desc')
							->select('id')
							->first();
		$lastdetailid = $latest2['id'];

		$finishings = $calc['finishings'];
		foreach($finishings as $i => $finishing)
		{
			$detailfin = new Cartdetailfinishing;
			$detailfin->finishingID = $finishing['id'];
			$detailfin->cartdetailID = $lastdetailid;
			$detailfin->optionID = $finishing['optionID'];
			$detailfin->quantity = $calc['totaldruct'];
			$detailfin->buyprice = 0;
			$detailfin->sellprice = $finishing['totalprice'];
			$detailfin->side = 0; // belom di buat

			$detailfin->save();
		}

		/*Mail::send('index', ['datas'=>$data], function ($message)
        {
            //$message->from('indrasaswita@gmail.com', 'Jakarta Brosur No-reply');
            $message->to('rahayu_printing@yahoo.co.id')
                    ->subject('Cart Placed Reminder!');
        });*/
		return "success";
	}

	
}
