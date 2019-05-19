<?php
	public function storeCartData($data)
	{
		//DIPAKE BUAT GLOBAL, BUKAN HANYA DARI SHOP, tapi bisa tembak langsung dari ADMIN CART

		$input = $request->all();

		$data = $input['selected'];
		$calc = Crypt::decrypt($input['calculation']);
		$total = $input['total'];

		$customerID = session()->get('userid');

		$header = new Cartheader();

		$header->customerID = $customerID;
		$header->jobsubtypeID = $data['jobsubtypeID'];
		$header->jobtitle = $data['jobtitle'];

		$header->quantity = $data['quantity'];
		$header->quantitytypename = $data['satuan'];
		
		$header->customernote = $data['customernote'];
		$header->itemdescription = $data['itemdescription'];
		
		$header->resellername = $data['resellername'];
		$header->resellerphone = $data['resellerphone'];
		$header->reselleraddress = $data['reselleraddress'];

		$header->buyprice = 0;

		$header->printprice = $total['price'];
		$header->deliveryprice = $total['deliv'];
		$header->discount = $total['disc'];

		$header->processtype = $data['processtime'];
		$header->processtime = $total['processday'];
		$header->deliveryID = $data['delivery']['id'];
		$header->deliveryaddress = $data['deliveryaddress'];
		$header->deliverytime = $total['deliveryday'];
		
		$header->totalpackage = $this->ceil($data['quantity']/$data['perbungkus'], 1);
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
?>