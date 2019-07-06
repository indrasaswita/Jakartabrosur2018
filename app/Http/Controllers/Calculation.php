<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Constant;
use App\Papersize;
use App\Paper;
use App\Paperdetail;
use App\Finishing;
use App\Finishingoption;
use App\Printingdigitalprice;
use App\Jobsubtype;
use App\Delivery;
use App\Offday;
use App\Size;
use App\Printingmachine;
use App\Helpers\MathHelper;
use App\Logic\Utility\Jobflyer;
use App\Logic\Utility\Jobplotter;
use App\Logic\Utility\Jobbusinesscard;
use App\Logic\Utility\Jobdeskcalendar;
use App\Logic\Utility\Jobcuttingsticker;
use App\Logic\Utility\Jobprintcutsticker;
use DB;
use Carbon\Carbon;
use Crypt;

class Calculation extends Controller
{
	private $jobsubtypes = null;
	private $cs = array();
	private $calculation = array();
	private $texttoread = "<div class='text-bold'>AN OFFER IN A TEXT</div><hr class='margin-5-0'>";
	private $textcombination = "COMBINATION<br>";


	public function initDataFromDB(&$data){
		if($data['sizeID'] != 0)
			$data['size'] = Size::findOrFail($data['sizeID']);
		//ELSE KALO SIZE ID 0 = CUSTOM
		//SIZENYA UDA DI INPUT LANGSUNG DARI DEPAN
		$data['printer'] = Printingmachine::findOrFail($data['printerID']);
		$data['paper'] = Paper::with('paperdetail')
				->where('id', $data['paperID'])
				->first();
		$data['delivery'] = Delivery::findOrFail($data['deliveryID']);
		$data['jobsubtype'] = Jobsubtype::findOrFail($data['jobsubtypeID']);

		foreach ($data['finishings'] as $i => $ii) {
			if($ii!=null){
				$data['finishings'][$i]['finishing'] = 
					Finishing::where('id', $ii['finishingID'])
						->where('status', 1)
						->first();
				if($data['finishings'][$i]['finishing']!=null)
					$data['finishings'][$i]['option'] = Finishingoption::findOrFail($ii['optionID']);
				else //kalo statusnya 0
					unset($data['finishings'][$i]);	
			}else{
				unset($data['finishings'][$i]);
			}
		}
		//pass references
	}

	public function convDataNUMBER($data){
		$data['perbungkus'] = intval($data['perbungkus']);
		$data['sideprint'] = intval($data['sideprint']);

		$data['size']['length'] = floatval($data['size']['length']);
		$data['size']['width'] = floatval($data['size']['width']);

		return $data;
	}

	public function calcPerJob($job, $data){
		$obj = null;
		$this->texttoread .= "Qty: <b>".MathHelper::thseparator($data['quantity'])."</b> ".$data['satuan']."<br>";
		
		if ($job == "flyer" || 
					$job == "letterhead" || 
					$job == "flyerlipat" ||
					$job == "flyerkupon" ||
					$job == "sticker"){
			//FLYER & KOP SURAT SAMA
			$obj = new Jobflyer($data, $this->cs);
			$obj->hitungFlyer();
			$obj->calcFinishing();
		}else if($job == "cuttingsticker"){
			$obj = new Jobcuttingsticker($data, $this->cs);
			$obj->setMachineID(10);
			$obj->setMargin(0, 0, 0, 0);
			$obj->hitungCutting();
			$obj->calcFinishing();
		}else if($job == "printcutsticker"){
			$obj = new Jobprintcutsticker($data, $this->cs);
			$obj->hitungPrint();
			$obj->hitungCuttingA3();
			$obj->calcFinishing();
		}else if($job == "businesscard"){
			//KARENA BOX
			$data['totalbox'] = $data['quantity'];
			$data['quantity'] *= 100;

			$obj = new Jobbusinesscard($data, $this->cs);
			$obj->hitungFlyer();
			$obj->tambahBoxKartuNama(1500);
			$obj->calcFinishing();
		}else if($job == "kartupanitia"){
			$obj = new Jobflyer($data, $this->cs);
			$obj->hitungFlyer();
			$obj->calcFinishing();
		}else if($job == "standbanner"){
			$obj = new Jobplotter($data, $this->cs);

			$obj->setMargin(0,15,5,40);
			$obj->setMachineID(8);
			$obj->hitungPlotter();

			$obj->calcFinishing();
		}else if($job == "simplebannerindoor"){
			//input size dalam cm

			$obj = new Jobplotter($data, $this->cs);

			$obj->setMargin(0,0,6,40);
			$obj->setMachineID(8);
			$obj->hitungPlotter();

			$obj->calcFinishing();

		}else if($job == "simplebanneroutdoor"){
			//input size dalam cm
			$obj = new Jobplotter($data, $this->cs);

			$obj->setMargin(0,0,6,60);
			$obj->setMachineID(9);
			$obj->hitungPlotter();

			$obj->calcFinishing();

		}else if($job == "deskcalendar"){
			$obj = new Jobdeskcalendar($data, $this->cs);
			$obj->hitungKalender();

			$obj->calcFinishing();
			//sudah sekalian finishing untuk setiap kertasnya, tapi belom finsihing global
		}else if($job == "manualinvoice"){
			$obj = new Jobmanualinvoice($data, $this->cs, $this->jobsubtype);
			$obj->hitungManualinvoice();
			//sudah sekalian finishing untuk setiap kertasnya, tapi belom finsihing global
		}else{
			return null; // error
		}


		

		if($obj != null){
			$this->textcombination .= $obj->getTextcombination();
			$this->texttoread .= $obj->getTexttoread();

			//print_r($obj->getData()['total']);
			$this->texttoread .= "<div class='text-xs-right'><b class='pull-xs-left'>KERTAS</b>  <span class='tx-purple'>".MathHelper::thseparator($obj->getData()['total']['paperprice'])."</span></div>";
			$this->texttoread .= "<div class='text-xs-right'><b class='pull-xs-left'>CETAK</b>  <span class='tx-purple'>".MathHelper::thseparator($obj->getData()['total']['cetakprice'])."</span></div>";
			$this->texttoread .= "<div class='text-xs-right'><b class='pull-xs-left'>FIN</b>  <span class='tx-purple'>".MathHelper::thseparator($obj->getData()['total']['finishingprice'])."</span></div>";
			$this->texttoread .= "<div class='text-xs-right'><b class='pull-xs-left'>TOTAL</b>  <span class='tx-purple'>".MathHelper::thseparator($obj->getData()['total']['price'])."</span></div><br>";

			$this->texttoread .= "<div class='text-xs-center size-200p'>Rp <b>".MathHelper::thseparator($obj->getData()['total']['price'])."</b></div>";

			return $obj->getData(); 
		}
		else if($obj == null)
			return null; // error
	}

	public function calcPrice(Request $request){

		$data = $request->all();
		$this->initDataFromDB($data); //passing by reference

		//BAG 1: COnv Jadi Number
		$data = $this->convDataNUMBER($data);

		//BAG 2: AMBIL JOBSUBTYPE sesuai data
		//$this->jobsubtype = Jobsubtype::findOrFail($data['jobsubtypeID']);
		//.  MOVE
		//pindah ke $data['jobsubtype'];


		//BAG 3: ambil data =>> set ke $cs
		$constants = Constant::all();
		foreach ($constants as $i => $item) {
				$this->cs[$item['name']] = $item['price'];
		}
		unset($constants); // HAPUS



		//BAG 5: calculate intinya
		$job = $data['jobsubtype']['link'];
		// *******************
		$this->texttoread .= "<b class='tx-gray'>".$data['jobsubtype']['name']."</b> ".$data['jobtitle']."<br>";

		$data = $this->calcPerJob($job, $data);
		if($data == null)
			return "BELOM TERDAFTAR, BELOM BISA DIPAKE";

		//BAG 6: calculate sisanya
		$data = $this->hitungEstimasiWaktu($data);
		$data = $this->hitungBeratTotal($data);
		$data = $this->hitungDeliveryPrice($data);

		if($data['jobtitle']=='')
			$data['jobtitle'] = $data['jobsubtype']['name'].' (Tanpa Judul)';

		//ADDITIONAL: buat bikin waiting animation
		$data['total']['counter'] = $data['counter'];


		//BAG 4: calculate finishing
		//$data = $this->calcFinishing($data);

		//$this->calculation -> isinya baru index finishing

		$this->calculation['paper'] = $data['paper'];
		$this->calculation['calculation'] = $data['calculation'];
		$this->calculation['finishings'] = $data['finishings'];
		$this->calculation['total'] = $data['total'];
		//JADI YANG DI KIRIM DATA2 yang penting di kelompokin
		$this->kelompokDataInputan($this->calculation['input'], $data);
		//kelompokin data juga yang dateng dari inputan

		$result = array();
		//$result['data'] = $data;
		$this->calculation['texttoread'] = $this->texttoread;
		$result['key'] = Crypt::encrypt($this->calculation);
		$result['total'] = $data['total'];

		if(session()->has('role'))
		{
			if(session()->get('role')=='Administrator')
				$result['texttoread'] = $this->texttoread; 
				$result['textcombination'] = $this->textcombination;
		}
		//return $data;
		return $result;
	}

	public function kelompokDataInputan(&$input, $data){
		$input['printtype'] = $data['printtype'];
		$input['imagewidth'] = $data['size']['width'];
		$input['imagelength'] = $data['size']['length'];
		$input['printsize'] = $data['size']['name'];
		$input['sideprint'] = $data['sideprint'];
		$input['processtime'] = $data['processtime'];
		$input['reseller'] = $data['reseller'];
		$input['jobsubtypeID'] = $data['jobsubtypeID'];
		$input['jobtitle'] = $data['jobtitle'];
		$input['customernote'] = $data['customernote'];
		$input['itemdescription'] = $data['itemdescription'];
		$input['resellername'] = $data['resellername'];
		$input['resellerphone'] = $data['resellerphone'];
		$input['reselleraddress'] = $data['reselleraddress'];
		$input['jobsubtypename'] = $data['jobsubtype']['name'];
		$input['quantity'] = $data['quantity'];
		$input['satuan'] = $data['satuan'];
		$input['deliveryaddress'] = $data['deliveryaddress'];
		$input['deliveryID'] = $data['delivery']['id'];
		$input['printerID'] = $data['printerID'];
	}

	public function addWorkDay($date, $num){
		$dayleft = $num;

		$curr = $date;
		for(;$dayleft>0;)
		{
			$curr = $curr->addDay();

			$holiday = false;
			$test = Offday::where('offday', '=', $curr->format('Y/m/d'))
					->where('status', '<', '2')
					->get();
			if($test!=null)
				if(count($test)>0)
					$holiday = true;
			if(date('N', strtotime($curr)) != 7 && !$holiday)
			{
				$dayleft--;
			}
		}
		return $curr;
	}

	public function isOpenDay($date){
		$curr = $date;
		for($i=0;$i<1000;$i++)
		{
			//1000 attempt, supaya ga looping forever
			$closed = false;
			$test = null;
			$test = Offday::where('offday', '=', $curr->format('Y/m/d'))
					->where(function($q){
						$q->where('status', '=', '0')
							->orWhere('status', '=', '2');
					})
					->get();
			if($test != null)
				if(count($test)>0)
					$closed = true;
			if(!$closed && date('N', strtotime($curr)) != 7 )
			{
				return $curr;
			}
			$curr = $curr->addDay();
		}
	}

	public function hitungEstimasiWaktu(&$data){
		if($data['printtype'] == 'OF')
		{
			$stdday = $data['jobsubtype']['stdoffset'];
			$expday = $data['jobsubtype']['expoffset'];
		}
		else
		{
			$stdday = $data['jobsubtype']['stddigital'];
			$expday = $data['jobsubtype']['expdigital'];
		}

		//DELIVERY DAY
		if($data['delivery'] != null)
		{
			$totaldeliveryday = intval($data['delivery']['dayservice']);
		}


		//HARUS DI INIT DULU, KALO GA, GA KEBACA
		$totalprocessday = 0;
		$totaldeliveryday = 0;

		//PRINT DAY
		if($data['processtime'] == "std")
			$totalprocessday = intval($stdday);
		else
			$totalprocessday = intval($expday);

		//TAMBAHIN WAKTU FINISHING
		if(is_array($data['finishings'])){
			foreach ($data['finishings'] as $i => $ii) {
				$totalprocessday += intval($ii['option']['processdays']);
			}
		}

		//DITAMBAHIN HARINYA SESUAI WAKTU KERJA
		$afterprint = $this->addWorkDay(Carbon::now(), $totalprocessday);
		//DITAMBAHIN HARINYA SAMPE DIA BUKA
		$afterprint = $this->isOpenDay($afterprint);
		//PENGIRIMAN DITAMBAHIN
		$afterdelivery = $this->addWorkDay(Carbon::now(), $totalprocessday + $totaldeliveryday);
		//TAPI GA PERLU DI CEK BUKANYA, KAN KIRA2 statusnya.

		$data['total']["afterprint"] = $afterprint->format('d M y');
		$data['total']["afterprintdom"] = $afterprint->formatLocalized('%A');
		$data['total']["processday"] = $totalprocessday;
		$data['total']["deliveryday"] = $totaldeliveryday;
		$data['total']["afterdelivery"] = $afterdelivery->format('d M y');
		$data['total']["afterdeliverydom"] = $afterdelivery->formatLocalized('%A');
		$data['total']['afterdeliverydiff'] = $afterdelivery->diffForHumans();

		return $data;
	}

	public function hitungBeratTotal(Array $data){
		$quantity = $data['quantity'];
		$imagewidth = $data['size']['width'];
		$imagelength = $data['size']['length'];
		$gramature = $data['paper']['gramature'];

		$weight = $this->calcPaperWeight($quantity, $imagewidth, $imagelength, $gramature);
		$data['total']['weight'] = $weight;

		return $data;
	}

	public function hitungDeliveryPrice(Array $data){
		$distance = 0;
		$delivID = $data['delivery']['id'];
		$deliveryprice = $this->calcDelivPrice($delivID, $distance, $data['total']['weight']);

		$data['total']['deliv'] = $deliveryprice;

		return $data;
	}

	public function calcPaperWeight($quantity, $width, $length, $gramature){
		return $quantity * $width * $length * $gramature / 20000 / 500;
	}


	public function calcDelivPrice($delivID, $distance, $weight){
		$price = 0;
		$weight = MathHelper::ceil($weight, 1);
		$deliv = Delivery::findOrFail($delivID);
		if($deliv['priceper'] == 'kg')
		{
			$price += $weight * floatval($deliv['price']);
		}
		$price += $deliv['baseprice'];
		return $price;
	}

}
