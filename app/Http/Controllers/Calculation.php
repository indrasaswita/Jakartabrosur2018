<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Constant;
use App\Papersize;
use App\Paper;
use App\Paperdetail;
use App\Finishing;
use App\Printingdigitalprice;
use App\Jobsubtype;
use App\Delivery;
use App\Offday;
use App\Helpers\MathHelper;
use DB;
use Carbon\Carbon;
use Crypt;

class Calculation extends Controller
{
	private $jobsubtypes = null;
	private $cs = array();
	private $calculation = array();

	public function getPrice(Request $request){

		$data = $request->all();

		$data['perbungkus'] = intval($data['perbungkus']);
		$data['sideprint'] = intval($data['sideprint']);

		//return $data['size'];

		$data['size']['length'] = floatval($data['size']['length']);
		$data['size']['width'] = floatval($data['size']['width']);

		$this->jobsubtype = Jobsubtype::findOrFail($data['jobsubtypeID']);

		//ambil data =>> set ke $cs
		$constants = Constant::all();
		foreach ($constants as $i => $item) {
				$this->cs[$item['name']] = $item['price'];
		}
		unset($constants);

		$finishings = Finishing::where('status', '=', 1)->with('finishingoption')->get();

		for ($i = count($data['finishings'])-1; $i >= 0; $i--) {
			//jika optionID = 0 < ['id']
			if($data['finishings'][$i]['id'] == 0)
			{
				array_splice($data['finishings'], $i, 1);
			}
			//jika tidak 0 =>> maka di cek datanya di masukkan harganya - 0 berarti dipilih tanpa finishing
			else
			{
				foreach ($finishings as $j => $finishing) {
					if($finishing['id'] == $data['finishings'][$i]['finishingID'])
					{
						foreach ($finishing['finishingoption'] as $k => $option) {
							if($option['id'] == $data['finishings'][$i]['id']){
								$data['finishings'][$i]['price'] = floatval($option['price']);
								$data['finishings'][$i]['priceper'] = $option['priceper'];
								$data['finishings'][$i]['priceminim'] = intval($option['priceminim']);
								$data['finishings'][$i]['pricebase'] = intval($option['pricebase']);
							}
						}
					}
				}
			}
		}
		unset($finishings);


		$jobsubtypename = strtolower($data['jobsubtypename']);
		if ($jobsubtypename == "flyer" || $jobsubtypename == "letterhead")
		{
			$data = $this->hitungFlyer($data);
		}
		else if($jobsubtypename == "businesscard")
		{
			//KARENA BOX
			$data['quantity'] *= 100;
			$data = $this->hitungFlyer($data);
			$data['quantity'] /= 100;
			$data = $this->tambahBoxKartuNama($data, 1300);
		}
		else if($jobsubtypename == "rollupbanner")
		{
			$data = $this->hitungRollUp($data);
			$data = $this->addDigitalAttr($data);
		}
		else if($jobsubtypename == "xbanner")
		{
			$data = $this->hitungXbanner($data);
			$data = $this->addDigitalAttr($data);
		}
		else if($jobsubtypename == "simplebannerindoor")
		{
			//input size dalam m
			$data = $this->hitungSimpleBannerIndoor($data);
			$data = $this->addDigitalAttr($data);
		}
		else if($jobsubtypename == "simplebanneroutdoor")
		{
			//input size dalam m
			$data = $this->hitungSimpleBannerOutdoor($data);
			$data = $this->addDigitalAttr($data);
		}

		$data = $this->hitungEstimasiWaktu($data);
		$data = $this->hitungBeratTotal($data);
		$data = $this->hitungDeliveryPrice($data);

		$totalfinishing = $this->hitungFinishing($data);

		if($data['jobtitle']=='')
			$data['jobtitle'] = $this->jobsubtype['name'].' (Tanpa Judul)';

		//buat bikin waiting animation
		$data['total']['counter'] = $data['counter'];


		$this->groupCalc($this->calculation, $data['paper']);
		$calc = $this->calculation;

		$result = array();
		//$result['data'] = $data;
		$result['key'] = Crypt::encrypt($calc);
		$result['total'] = $data['total'];
		//return $data;
		return $result;

		//return $this->bersihinData($data);
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

	public function groupCalc(&$a, $b)
	{
		$a['paperID'] = $b['paperID'];
		$a['planoID'] = $b['planoID'];
		$a['vendorID'] = $b['vendorID'];
		$a['buyprice'] = 0;
		$a['printwidth'] = $b['printwidth'];
		$a['printlength'] = $b['printlength'];
		$a['totaldruct'] = $b['totaldruct'];
		$a['inschiet'] = $b['inschiet'];
		$a['totalplano'] = $b['totalplano'];
		$a['totalinplano'] = $b['totalinplano'];
		$a['totalinplanox'] = $b['totalinplanox'];
		$a['totalinplanoy'] = $b['totalinplanoy'];
		$a['totalinplanorest'] = $b['totalinplanorest']==null?0:$b['totalinplanorest'];
		$a['totalinprint'] = $b['totalinprint'];
		$a['totalinprintx'] = $b['totalinprintx'];
		$a['totalinprinty'] = $b['totalinprinty'];
		$a['totalinprintrest'] = $b['totalinprintrest']==null?0:$b['totalinprintrest'];
		$a['totalpaperprice'] = $b['totalpaperprice'];
	}

	public function addDigitalAttr(Array $data)
	{
		$data['paper']['inschiet'] = 0;

		return $data;
	}

	public function hitungEstimasiWaktu(Array $data)
	{
		if($data['printtype'] == 'OF')
		{
			$stdday = $this->jobsubtype['stdoffset'];
			$expday = $this->jobsubtype['expoffset'];
		}
		else
		{
			$stdday = $this->jobsubtype['stddigital'];
			$expday = $this->jobsubtype['expdigital'];
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
		foreach ($data['finishings'] as $i => $finishing) {
			$totalprocessday += intval($finishing['processdays']);
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

	public function hitungBeratTotal(Array $data)
	{
		$quantity = $data['quantity'];
		$imagewidth = $data['size']['width'];
		$imagelength = $data['size']['length'];
		$gramature = $data['paper']['gramature'];

		$weight = $this->calcPaperWeight($quantity, $imagewidth, $imagelength, $gramature);
		$data['total']['weight'] = $weight;

		return $data;
	}

	public function hitungDeliveryPrice(Array $data)
	{
		$distance = 0;
		$delivID = $data['delivery']['id'];
		$deliveryprice = $this->calcDelivPrice($delivID, $distance, $data['total']['weight']);

		$data['total']['deliv'] = $deliveryprice;

		return $data;
	}

	public function hitungRollUp(Array $data)
	{

		$imagewidth = $data['size']['width'];
		$imagelength = $data['size']['length'];
		$qty = $data['quantity'];
		$bleedwidth = 0;
		$bleedlength = 20;
		$marginwidth = 5;
		$marginlength = 40;
		$max_print_width = 160;
		$paperID = $data['paper']['id'];

		$data = $this->calcPlanoSizeRoll($data, $imagewidth, $imagelength, $qty, $bleedwidth, $bleedlength, $marginwidth, $marginlength, $max_print_width, $paperID, $max_print_width);

		$totalarea = $data['paper']['totalarea'];
		//setelah calcPlanoSizeRoll -- paper.id -> paper.paperID
		$paperID = $data['paper']['paperID'];
		$planoID = $data['paper']['planoID'];

		$paperprice = $this->calcPaperPricePlotter($totalarea, $paperID, $planoID);

		$cetakprice = $this->calcPrintPriceIndoor($totalarea);

		$data = $this->calcFinishingBanner($data, $qty, $data['finishings'], $totalarea);

		$data['total']['paperprice'] = $paperprice;
		$data['total']['cetakprice'] = $cetakprice;
		$data['total']['price'] = $cetakprice + $paperprice;
		$data['total']['disc'] = 0;

		return $data;
	}

	public function hitungXbanner(Array $data)
	{
		$imagewidth = $data['size']['width'];
		$imagelength = $data['size']['length'];
		$qty = $data['quantity'];
		$bleedwidth = 0;
		$bleedlength = 15;
		$marginwidth = 5;
		$marginlength = 40;
		$max_print_width = 160;
		$paperID = $data['paper']['id'];

		$data = $this->calcPlanoSizeRoll($data, $imagewidth, $imagelength, $qty, $bleedwidth, $bleedlength, $marginwidth, $marginlength, $max_print_width, $paperID, $max_print_width);

		$totalarea = $data['paper']['totalarea'];
		$paperID = $data['paper']['paperID'];
		$planoID = $data['paper']['planoID'];

		$paperprice = $this->calcPaperPricePlotter($totalarea, $paperID, $planoID);

		$cetakprice = $this->calcPrintPriceIndoor($totalarea);

		$data = $this->calcFinishingBanner($data, $qty, $data['finishings'], $totalarea);

		$data['total']['paperprice'] = $paperprice;
		$data['total']['cetakprice'] = $cetakprice;
		$data['total']['price'] = $cetakprice + $paperprice;
		$data['total']['disc'] = 0;

		return $data;
	}


	public function hitungSimpleBannerOutdoor(Array $data)
	{
		$imagewidth = $data['size']['width'] * 100;
		$imagelength = $data['size']['length'] * 100;
		$qty = $data['quantity'];
		$bleedwidth = 6;
		$bleedlength = 6;
		$marginwidth = 2;
		$marginlength = 20;
		$max_print_width = 320;
		$paperID = $data['paper']['paperID'];

		$data = $this->calcPlanoSizeRoll($data, $imagewidth, $imagelength, $qty, $bleedwidth, $bleedlength, $marginwidth, $marginlength, $max_print_width, $paperID, $max_print_width);

		$totalarea = $data['paper']['totalarea'];
		$paperID = $data['paper']['paperID'];
		$planoID = $data['paper']['planoID'];

		$paperprice = $this->calcPaperPricePlotter($totalarea, $paperID, $planoID);

		$cetakprice = $this->calcPrintPriceIndoor($totalarea);

		$data = $this->hitungSimpleBannerIndoor($data);

		// FINISHING BANNER (DIHITUNG PER METER)
		$data['size']['width'] /= 100;
		$data['size']['length'] /= 100;

		$data = $this->calcFinishingBanner($data, $qty, $data['finishings'], $totalarea);

		$data['total']['paperprice'] = $paperprice;
		$data['total']['cetakprice'] = $cetakprice;
		$data['total']['price'] = $cetakprice + $paperprice;
		$data['total']['disc'] = 0;

		return $data;
	}

	public function hitungSimpleBannerIndoor(Array $data)
	{
		$imagewidth = $data['size']['width']*100;
		$imagelength = $data['size']['length']*100;
		$qty = $data['quantity'];
		$bleedwidth = 0;
		$bleedlength = 0;
		$marginwidth = 6;
		$marginlength = 20;
		$max_print_width = 160;
		$paperID = $data['paper']['paperID'];

		$data = $this->calcPlanoSizeRoll($data, $imagewidth, $imagelength, $qty, $bleedwidth, $bleedlength, $marginwidth, $marginlength, $max_print_width, $paperID, $max_print_width);

		$totalarea = $data['paper']['totalarea'];
		$paperID = $data['paper']['paperID'];
		$planoID = $data['paper']['planoID'];

		$paperprice = $this->calcPaperPricePlotter($totalarea, $paperID, $planoID);

		$cetakprice = $this->calcPrintPriceIndoor($totalarea);

		// FINISHING BANNER (DIHITUNG PER METER)
		$data['size']['width'] /= 100;
		$data['size']['length'] /= 100;

		$data = $this->calcFinishingBanner($data, $qty, $data['finishings'], $totalarea);

		$data['total']['paperprice'] = $paperprice;
		$data['total']['cetakprice'] = $cetakprice;
		$data['total']['price'] = $cetakprice + $paperprice;
		$data['total']['disc'] = 0;

		return $data;
	}

	public function hitungFinishing(& $data)
	{

		foreach ($data['finishings'] as $i => $finishing) {	

			//MASUKIN DATA ID ke Total
			$this->calculation['finishings'][$i]['id'] = $data['finishings'][$i]['finishingID'];
			$this->calculation['finishings'][$i]['optionID'] = $data['finishings'][$i]['id'];
			$this->calculation['finishings'][$i]['quantity'] = 0;


			//FINIHSING ID --> 6 --> POTONG
			//ubah sesuai finishing ID yang di database
			//if(strtolower($finishing['finishingID']) != 6 || $data['printtype']!="OF")
			//{
				// UNTUK FINISHING SELAIN POTONG OFFSET
				if($finishing['priceper'] == "cm")
				{
					$this->calculation['finishings'][$i]['totalprice'] = MathHelper::ceil($data['paper']['printwidth'] * $data['paper']['printlength'] * $finishing['price'] * $data['paper']['totaldruct'], 10000) + $finishing['pricebase'];
					if($this->calculation['finishings'][$i]['totalprice'] < $finishing['priceminim'])
						$this->calculation['finishings'][$i]['totalprice'] = $finishing['priceminim'];
				}
				else if($finishing['priceper'] == 'pcs')
				{
					$this->calculation['finishings'][$i]['totalprice'] = MathHelper::ceil($finishing['price'] * $data['paper']['totaldruct'], 10000) + $finishing['pricebase'];
					if($this->calculation['finishings'][$i]['totalprice'] < $finishing['priceminim'])
						$this->calculation['finishings'][$i]['totalprice'] = $finishing['priceminim'];
				}
				else if($finishing['priceper'] == "m")
				{
					//untuk indoor outdoor
				}
				else if($finishing['priceper'] == "kg")
				{
					//UNTUK POTONG (DEPRECATED - POtong masuk ek cutting price)
					//$temp = MathHelper::ceil($finishing['price'] * $data['paper']['totaldruct'] * $data['paper']['printwidth'] * $data['paper']['printlength'] * $data['paper']['gramature'] / 20000 / 500, 1000) + $finishing['pricebase'];

					$temp = $this->hargaPerKgMnl($data['paper']['gramature'], $data['paper']['printwidth'], $data['paper']['printlength'], $data['paper']['totaldruct'], $finishing['price'], $finishing['priceminim'], $finishing['pricebase']);
					$this->calculation['finishings'][$i]['totalprice'] = $temp;

					//$temp = $this->hargaPotong($)
				}
			//}
			//else
			//{
				//KALO ADA FINISHING POTONG
				//$this->calculation['finishings'][$i]['totalprice'] = $data['total']['cuttingprice'];
			//}
			$data['total']['price'] += $this->calculation['finishings'][$i]['totalprice'];
		}
	}

	public function hitungFlyer (Array $data)
	{
		$quantity = 0;
		$width = 0;
		$length = 0;
		$gramature = 0;
		$stdday = 0;
		$expday = 0;

		$inschiet = 0;
		$hperplat = 0;
		$minim1000 = 0;
		$hperdruct = 0;

		//$hpotongperkg = $this->cs['BiayaPotongPerKg'];
		//$hpotongminim = $this->cs['OngkosMinimPotong'];

		if($data['printtype'] == "OF")
		{
			$inschiet = floatval($this->cs['InschietSM52']);
			$hperplat = $this->cs['BiayaPlatSM52'];
			$minim1000 = $this->cs['OngkosCetakMinimSM52'];
			$hperdruct = $this->cs['OngkosCetakSisaSM52'];

			//KALO SM52
			$marginlength = 0.8; // dalam cm
			$marginwidth = 0.4; // dalam cm
			$max_print_length = 51;
			$max_print_width = 36;
			$bleed = 0.4;
			$jepitan = 1.0;
		}
		else if($data['printtype'] == 'DG')
		{
			/*$inschiet = 0;
			$hperplat = 0;
			$minim1000 = 0;
			$hperdruct = 0;*/

			$marginwidth = 0.5;
			$marginlength = 0.5;
			$max_print_length = 48;
			$max_print_width = 33;
			$bleed = 0.4;
			$jepitan = 0;
		}

		$paperID = $data['paper']['id'];

		$sdp = $data['sideprint'];
		$qty = $data['quantity'];

		$imagesize = $data['size'];
		//size sudah dalam FLOAT
		$imagewidth = $imagesize['width'];
		$imagelength = $imagesize['length'];


		$data = $this->calcPlanoSize($data, $imagewidth, $imagelength, $qty, $sdp, $inschiet, $minim1000, $hperdruct, $bleed, $jepitan, $hperplat, $marginwidth, $marginlength, $max_print_width, $max_print_length, $paperID);

		$price = 0; // INIT HARGA
		$printdata = $data['paper'];
		$totalinprint = intval($printdata['totalinprint']);
		$totalinplano = intval($printdata['totalinplano']);
		$planoID = intval($printdata['planoID']);


		if($data['printtype'] == 'OF')
		{
			$paperprice = $this->hargaKertas($data, $totalinprint, $totalinplano, $qty, $inschiet, $paperID, $planoID) + 100000; // tambahin buat ongkos beli ke indojaya
			$data['total']['paperpricesell'] = $paperprice; 

			// SAVE
			$cetakprice = $this->hargaCetak($printdata, $qty, $inschiet, $hperdruct, $minim1000, $sdp, $hperplat);
			//$cuttingprice = $this->hargaPotong($printdata, $qty, $inschiet, $hpotongperkg, $hpotongminim);

			$gramature = $data['paper']['gramature'];

		}
		else if($data['printtype'] == 'DG')
		{
			$totalpaperprint = MathHelper::ceil($qty/$totalinprint, 1);
			$data['paper']['totaldruct'] = $totalpaperprint;
			$data['paper']['totalplano'] = 0;
			$totaldruct = $sdp * $totalpaperprint;

			$paperprice = $this->calcPaperPriceDigital($paperID, $totalpaperprint);
			//$paperprice = $this->hargaKertas($data, $totalinprint, $totalinplano, $qty, $inschiet, $paperID, $planoID);
			if($paperprice > 0)
			{
				$cetakprice = $this->calcPrintPriceDigital($totaldruct);

				$gramature = 500;
			}
			else
			{
				$cetakprice = 0;
				$gramature = 0;
			}


			//$price += $this->hargaPotongMnl($data['paper']['gramature'], 32, 48, $data['quantityA3'], $this->cs['BiayaPotongPerKg'], $this->cs['OngkosMinimPotong']);
		}

		$price = MathHelper::ceil($paperprice, 1000) + MathHelper::ceil($cetakprice, 1000);


		$paper = $data['paper'];
		$paper['planowidth'] = floatval($paper['planowidth']);
		$paper['planolength'] = floatval($paper['planolength']);
		$paper['perdruct'] = floatval($paper['perdruct']);
		$paper['minim1000'] = floatval($paper['minim1000']);
		$paper['inschiet'] = floatval($paper['inschiet']);
		$paper['hperpcs'] = floatval($paper['hperpcs']); //DELETE!

		$data['total'] = array(
			"price"=>MathHelper::ceil($price, 100),
			"disc"=>0,

			"paperprice"=>MathHelper::ceil($paperprice, 1000),
			//"paperpriceasli"=>$paperprice,
			"cetakprice"=>MathHelper::ceil($cetakprice, 1000),
			//"cetakpriceasli"=>$cetakprice, //1000,
		);


		return $data;
	}

	public function bersihinData(Array $data)
	{
		foreach ($data['finishings'] as $i => $finishing) {
			unset($data['finishings'][$i]['disabled']);
			unset($data['finishings'][$i]['pricebase']);
			unset($data['finishings'][$i]['priceminim']);
			unset($data['finishings'][$i]['priceper']);
			unset($data['finishings'][$i]['price']);
		}
		unset($data['jobsubtype']);
		unset($data['paper']['hperpcs']);
		unset($data['paper']['minim1000']);
		unset($data['paper']['perdruct']);
		unset($data['paper']['planowidth']);
		unset($data['paper']['planolength']);
		unset($data['size']['shortname']);
		unset($data['size']['name']);
		unset($data['size']['id']);
		unset($data['pagename']);

		unset($data['imagelength']);
		unset($data['imagewidth']);

		return $data;
	}

	public function calcFinishingBanner($data, $qty, $finishings, $totalarea)
	{
		foreach ($finishings as $i => $finishing) {
			if($finishing['priceper']=="m")
			{
				$finalprice = $totalarea * $finishing['price'] / 10000;
			}
			else if($finishing['priceper'] == "pcs")
			{
				$finalprice = $qty * $finishing['price'];
			}


			$finalprice += $finishing['pricebase'];
			if($finishing['priceminim'] > $finalprice)
				$finalprice = $finishing['priceminim'];

			$data['finishings'][$i]['totalprice'] = MathHelper::ceil($finalprice, 1000);
		}
		return $data;
	}

	public function calcPaperWeight($quantity, $width, $length, $gramature)
	{
		return $quantity * $width * $length * $gramature / 20000 / 500;
	}

	public function calcPaperPricePlotter($totalarea, $paperID, $planoID)
	{
		$unitprice = Paperdetail::where('paperID', '=', $paperID)
				->where('planoID', '=', $planoID)
				->select('unitprice')
				->first()['unitprice'];

		$unitprice = floatval($unitprice);
		//unitprice DALAM METER PERSEGI
		$unitprice /= 10000;
		//ubah jadi CM PERSEGI

		return MathHelper::ceil(floatval($totalarea) * $unitprice, 1000);
	}

	public function calcPaperPriceDigital($paperID, $totalpaperprint)
	{
		$paperdetail = Paperdetail::join('papersizes', 'papersizes.id', '=', 'planoID')
				->where('papersizes.width', '>=', 65)
				->where('papersizes.length', '>=', 100)
				->where('paperID', '=', $paperID)
				->orderBy('unitprice', 'ASC')
				->first();

		if($paperdetail != null)
		{
			$perlembar = $paperdetail['unitprice'] / 4;
			$paperprice = $totalpaperprint * $perlembar;
		}
		else
		{
			$paperprice = 0;
		}
		
		return $paperprice;
	}

	public function calcPrintPriceDigital($qty)
	{
		$qty = MathHelper::ceil($qty, 1);
		$unitprice = $this->getDGPriceByMachineID(5, $qty); //machineid 5 => 'digitalA3'
		return $unitprice * $qty;
	}

	public function calcPrintPriceIndoor($totalarea)
	{
		$unitprice = $this->getDGPriceByMachineID(8, MathHelper::ceil($totalarea, 0.5)); // Plotter Indoor 5pL

		return MathHelper::ceil($totalarea * $unitprice / 10000, 1000);
	}

	public function getDGPriceByMachineID($machineID, $qty)
	{
		$data = Printingdigitalprice::where('machineID', '=', $machineID)
				->orderBy('minqty', 'DESC')
				->where('minqty', '<=', $qty)
				->first();

		if($data!=null)
			return $data['unitprice'];
		else
			return 0;
	}

	public function calcCombinationByMachineDG($imagelength, $imagewidth, $bleed, $sdp)
	{
		$combination = [];
		$printlength = 47.5;
		$printwidth = 31.5;
		$bleed = 0.4;

		//CARA 1
		$hasil1 = $this->getTotalInConstantPaper($imagelength, $imagewidth, $printlength, $printwidth, $bleed);  	

		//CARA 2
		$hasil2 = $this->getTotalInConstantPaper($imagewidth, $imagelength, $printlength, $printwidth, $bleed);

		$combination = [];
		if($hasil1[4] < $hasil2[4])
		{
			$y = MathHelper::floor($printlength/($imagewidth+$bleed), 1);
			$x = MathHelper::floor($printwidth/($imagelength+$bleed), 1);
			if($x == 0 || $y == 0) {
			}else{
				$combination = $hasil2;
			}
		}
		else
		{
			$y = MathHelper::floor($printlength/($imagelength+$bleed), 1);
			$x = MathHelper::floor($printwidth/($imagewidth+$bleed), 1);
			if($x == 0 || $y == 0) {
			}else{
				$combination = $hasil1;
			}
		}

		$combination[5] = false; //dibuat cetak sekali dulu, kalo cetak 2 muka dan 8 plat = baru di double;
		if($sdp == 2){
			//CHECKED IF DOUBLE SIDED
			if($combination[2] % 2 != 0) 
				$combination[5] = true; //buat double cetak [5]
			//disimpan ke -> DOUBLE PRINT PRICE
		}

		$combinations = [];
		$combinations[0] = $combination;

		return $combinations;
	}

	public function getTotalInConstantPaper($imagelength, $imagewidth, $printlength, $printwidth, $bleed)
	{
		$j = intval($printlength / ($imagelength + $bleed));
		$i = intval($printwidth / ($imagewidth + $bleed));
		if($j < 1 || $i < 1) return 0;
		$lengthkepake = $j + ($imagelength + $bleed);
		$widthkepake = $i + ($imagewidth + $bleed);
		$total = $i * $j;
		if($total < 1) $total = 0;
		if($printlength - $lengthkepake < $imagewidth)
		{
			//MASIH BISA NYEMPIL WIDTH 1 lagi
			$sisai = intval(($printlength - $lengthkepake) / $imagewidth);
			$sisaj = intval($printwidth / $imagelength);
			$total += $sisai * $sisaj;
		}
		$total = MathHelper::floor($total, 1);
		$result = array($printlength, $printwidth, $i, $j, $total);
		return $result;
	}

	public function calcCombinationByMachine($imagelength, $imagewidth, $bleed, $jepitan, $max_print_length, $max_print_width, $sdp, $marginlength, $marginwidth)
	{
		// BENTUKNYA BRUTE FORCE (1-10)
		$combination = [];
		$calctemp = [];
		$jj = [];

		$max_count_length = $max_count_width = 10;

		for ($i=$max_count_length; $i>0; $i--) 
		{ 
			for ($j=1; $j<=$max_count_width; $j++) 
			{ 

				//HARUS REFRESH SETIAP PERULANGAN
				// I --> total perkalian di LENGTH
				$printlength = $i * ($imagelength + $bleed);
				// J --> total perkalian di WIDTH
				$printwidth = $j * ($imagewidth + $bleed);



				//MASUKKAN JEPITAN DULU
				if ($printwidth <= $printlength) 
				{ 
					$printwidth = $printwidth + $jepitan + ($marginwidth * 1); //JEPITAN
					$printlength = $printlength + ($marginlength * 2);
				} 
				else 
				{
					$printlength = $printlength + $jepitan + ($marginwidth * 1);
					$printwidth = $printwidth + ($marginlength * 2);
				}


				//CEK MASUK MESIN 52 gak?
				if($printwidth < $max_print_width)
				{
					if($printlength < $max_print_length)
					{
						$calctemp = array($printlength, $printwidth, $j, $i, $i*$j);
					}
				}
				else if($printwidth < $max_print_length)
				{
					if($printlength < $max_print_width)
					{
						$calctemp = array($printlength, $printwidth, $j, $i, $i*$j);
					}
				}
				//KALO MASUK 52 BARU BISA DI MASUKIN KE ARRTEMP
				// arrtemp =>> untuk nampung yang bisa di cetak..
			}

			if (count($calctemp)!=0)
			{
				//print_r ($calctemp);
				$duplicated = false;
				//CEK UDA ADA BELOM DI ARRAY
				foreach ($jj as $key => $value) {
					if($calctemp[3] == $value)
					{ // $calctemp[3] -> $j sama dengan jumlah barisnya
						$duplicated = true;
						// BUAT SUDAH ADA BILA KETEMU
					}
				}
				$calctemp[5] = false; //dibuat cetak sekali dulu, kalo cetak 2 muka dan 8 plat = baru di double;
				if($sdp == 2){
					//CHECKED IF DOUBLE SIDED
					if($calctemp[2] % 2 != 0) 
						$calctemp[5] = true; //buat double cetak [5]
					//disimpan ke -> DOUBLE PRINT PRICE
				}
				//MASUKIN DATA LAGI KALO BELOM ADA YANG SAMA
				if($duplicated == false)
				{
					//MASUKIN calctemp[2] ke $jj
					//echo ("0:".$calctemp[0].",1:".$calctemp[1].",2:".$calctemp[2].",3:".$calctemp[3]."\n");
					//buat cek keulang apa kagak
					array_push($jj, $calctemp[2]);
					//MASUKIN $calctemp(hasil) -> $combination
					array_push($combination, $calctemp);
					//kosongin lagi, abis di isi
					$calctemp = array();
				}
			}
		}
		return $combination;
	}

	public function getUkuranByPaperID($id)
	{
		return Paperdetail::join('papers', 'papers.id', '=', 'paperdetails.paperID')
				->join('papersizes', 'papersizes.id', '=', 'paperdetails.planoID')
				->join('vendors', 'vendors.id', '=', 'paperdetails.vendorID')
				->select('paperdetails.paperID', 'papersizes.width as planowidth', 'papersizes.length as planolength', 'papers.gramature', 'vendorID', 'papersizes.id as planoID')
				->where('papers.id', '=', $id)
				->where('available', '=', '1')
				->get(); // CEK YANG SEJENIS (WARNA, GRAM, NAMA)
	}

	public function calcPlanoSizeRoll(Array $data, $imagewidth, $imagelength, $qty, $bleedwidth, $bleedlength, $marginwidth, $marginlength, $max_print_width, $paperID, $max_width_machine)
	{
		$max_roll_width = array(90, 127, 152);
		$usedwidth = $imagewidth + $bleedwidth;
		$usedlength = $imagelength + $bleedlength;

		$planosizes = Paperdetail::join('papersizes', 'papersizes.id', '=', 'planoID')
					->where('paperID', '=', $paperID)
					->select('papersizes.id as planoID', 'papersizes.width', 'papersizes.length', 'vendorID')
					->where('papersizes.width', '<=', $max_width_machine)
					->distinct()
					->get();

		$combinations = $this->hitungPanjangRoll($qty, $usedwidth, $usedlength, $marginwidth, $marginlength, $planosizes);

		$mostefficient = -1;
		$temp = [];
		foreach ($combinations as $i => $combination) {
			// index 2 = panjang yang di pake
			// index 3 = lebar roll yang di looping

			$totalarea = floatval($combination[2]) * floatval($combination[3]);
			if($mostefficient == -1 || $mostefficient > $totalarea){
				$mostefficient = $totalarea;
				$temp = $combination;
			}
		}

		//ukuran area yang kepake ada di mostefficient -> DALAM CM
		$data['paper']['paperID'] = $data['paper']['id'];
		unset($data['paper']['id']);
		$data['paper']['totalarea'] = $mostefficient;
		$data['paper']['leftratio'] = $temp[0];
		$data['paper']['rightratio'] = $temp[1];
		$data['paper']['printlength'] = $temp[2];
		$data['paper']['printwidth'] = floatval($temp[3]);
		$data['paper']['planoID'] = $temp[4];
		$data['paper']['vendorID'] = $temp[5];
		$data['paper']['totalplano'] = $temp[6];

		$data['paper']['totaldruct'] = $data['quantity'];
		$data['paper']['totalinplano'] = 0;
		$data['paper']['totalinplanox'] = 0;
		$data['paper']['totalinplanoy'] = 0;
		$data['paper']['totalinplanorest'] = 0;
		$data['paper']['totalinprint'] = 0;
		$data['paper']['totalinprintx'] = 0;
		$data['paper']['totalinprinty'] = 0;
		$data['paper']['totalinprintrest'] = 0;

		$data['paper']['totalpaperprice'] = 0;

		return $data;
	}

	public function hitungPanjangRoll($qty, $usedwidth, $usedlength, $marginwidth, $marginlength, $planosizes)
	{
		/*
			return Array (leftqty, rightqty, usedrolllength, max_roll_width)
			*/
		$combinations = array();

		foreach ($planosizes as $i => $planosize) {

			$max = MathHelper::ceil(($planosize['width']-$marginwidth)/$usedlength, 1);
			for ($i=0; $i <= $max; $i++) { 
				$lebaryangkepake = $i * $usedlength;
				$sisa = ($planosize['width']-$marginwidth) - $lebaryangkepake;
				$dalamsisa = MathHelper::floor($sisa / $usedwidth, 1);

				$q1 = $i; //kiri
				$q2 = $dalamsisa; //kanan
				$totalusedlength = $q1 * $usedlength;
				$totalusedwidth = $q2 * $usedwidth;
				if($totalusedwidth + $totalusedlength != 0 && $q1 >= 0 && $q2 >= 0)
				{
					$temp = $this->hitungPorsiCetak($qty, $totalusedwidth, $totalusedlength);
					$totalkiri = $temp[0]; //total qty di kiri
					$totalkanan = $temp[1]; //total qty di kanan

					if($q1!=0)
						$panjangkiri = MathHelper::ceil($totalkiri / $q1, 1) * $usedwidth;
					else
						$panjangkiri = -1;

					if($q2!=0)
						$panjangkanan = MathHelper::ceil($totalkanan / $q2, 1) * $usedlength;
					else
						$panjangkanan = -1;

					$panjangroll = 0;
					if($panjangkiri < 0)
						$panjangroll = $panjangkanan;
					else if($panjangkanan < 0)
						$panjangroll = $panjangkiri;
					else
					{
						if ($panjangkiri > $panjangkanan)
							$panjangroll = $panjangkiri;
						else
							$panjangroll = $panjangkanan;
					}
					$panjangroll += $marginlength;

					$banyakroll = floatval($panjangroll) / floatval($planosize['length']);

					$temp2 = array($q1, $q2, $panjangroll, $planosize['width'], $planosize['planoID'], $planosize['vendorID'], $banyakroll);
					array_push($combinations, $temp2);
				}
			}
		}

		return $combinations;
	}

	public function hitungPorsiCetak($qty, $usedwidth, $usedlength)
	{
		$lengthportion = $usedlength / ($usedwidth + $usedlength);
		$widthportion = $usedwidth / ($usedwidth + $usedlength);

		$lengthtotalportion = MathHelper::round($lengthportion * $qty, 1);
		$widthtotalportion = MathHelper::round($widthportion * $qty, 1);

		if($lengthtotalportion + $widthtotalportion > $qty)
			$widthtotalportion--;

		return array($lengthtotalportion, $widthtotalportion);
	}

	public function calcPlanoSize_url(Request $request){
		/*$data = $request->all();
		$imagewidth 
		$imagelength 
		$qty 
		$sdp 
		$inschiet 
		$minim1000 
		$hperdruct 
		$bleed 
		$jepitan 
		$hperplat 
		$marginwidth 
		$marginlength 
		$max_print_width 
		$max_print_length
		$paperID*/
	}

	public function calcPlanoSize(Array $data, $imagewidth, $imagelength, $qty, $sdp, $inschiet, $minim1000, $hperdruct, $bleed, $jepitan, $hperplat, $marginwidth, $marginlength, $max_print_width, $max_print_length, $paperID)
	{

		if($data['printtype'] == 'OF')
		{
			$combinations = $this->calcCombinationByMachine($imagelength, $imagewidth, $bleed, $jepitan, $max_print_length, $max_print_width, $sdp, $marginlength, $marginwidth);
		}
		else if($data['printtype'] == 'DG')
		{
			$combinations = $this->calcCombinationByMachineDG($imagelength, $imagewidth, $bleed, $sdp);
			//$combinations = $this->calcCombinationByMachine($imagelength, $imagewidth, $bleed, $jepitan, $max_print_length, $max_print_width, $sdp, $marginlength, $marginwidth, $data['printtype']);
		}
		
		//CARI UKURAN-UKURAN (result: array)
		$papers = $this->getUkuranByPaperID($paperID);

		$themostefficient = 0; 
		// EFICIENT MULANYA DARI 0 <-- paling boros
		$thelowestprice = 9999999999;
		// PRICE MULAINYA DARI GEDE <-- paling boros
		$thispaper = [];

		foreach ($papers as $i => $paper) 
		{
			$planolength = floatval($paper['planolength']);
			$planowidth = floatval($paper['planowidth']);
			foreach ($combinations as $j => $value) 
			{
				$printlength = $value[0];
				$printwidth = $value[1];

				$totalPotongan = $this->totalKertasDalamPlano($planolength, $planowidth, $printlength, $printwidth);
				$totalPotongan2 = $this->totalKertasDalamPlano($planolength, $planowidth, $printwidth, $printlength);

				//kalo total potongannya lebih banyak yang kedua, tuker posisi
				if($totalPotongan2['totalpcs'] > $totalPotongan['totalpcs']) 
					$totalPotongan = $totalPotongan2;
				//$efficiency = $this->getEfficiency($totalPotongan['totalpcs'], $planolength, $planowidth); //MAKIN BESAR MAKIN 

				$paper['totalinplanox'] = $totalPotongan['totalx'];
				$paper['totalinplanoy'] = $totalPotongan['totaly'];
				$paper['totalinplano'] = $totalPotongan['totalpcs'];
				$paper['totalinplanorest'] = $totalPotongan['totalsisa'];
				$paper['printlength'] = $printlength;
				$paper['printwidth'] = $printwidth;
				$paper['totalinprintx'] = $value[2];
				$paper['totalinprinty'] = $value[3];
				$paper['totalinprint'] = $value[4];
				$paper['doubleprintprice'] = $value[5]; //kalo TRUE -> brarti harganya cetaknya
				$paper['inschiet'] = $inschiet;

				//CEK HARGA TERMURAH
				$hargacetak = $this->hargaCetak($paper, $qty, $inschiet, $hperdruct, $minim1000, $sdp, $hperplat);
				$hargakertas = $this->hargaKertas($data, $paper['totalinprint'], $paper['totalinplano'], $qty, $inschiet, $paperID, $paper['planoID']);
				$hargacetak += $hargakertas;

				$paper['totalpaperprice'] = $hargakertas;

				//EFISIEN DARI HARGA CETAK + KERTAS
				if ($hargacetak < $thelowestprice)
				{
					$thelowestprice = $hargacetak;

					$thispaper = clone $paper; 
					//KALO GA DI CLONE IKUT2AN sampe AKHIR
				}
			}
		}
		//KALO GA DI MASUKIN KE THISPAPER DULU, COLOR SAMA NAMENYA BAKAL ILANG
		$thispaper['color'] = $data['paper']['color'];
		$thispaper['name'] = $data['paper']['name'];
		$data['paper'] = $thispaper;

		return $data;
	}

	public function totalKertasDalamPlano($planolength, $planowidth, $printlength, $printwidth)
	{
			//1 - total
			$totalx = intval($planolength/$printlength);
			$sisax = $planolength%$printlength;

			//2 - cari jumlah dari sisa kertas plano
			if ($sisax > $printwidth)
					$totalysisa = intval($planowidth/$printlength);
			else
					$totalysisa = 0;

			//3 - cari jumlah dari total kertas plano
			$totaly = intval($planowidth/$printwidth);
			$totalxy = $totalx * $totaly;

			return array(
					'totalpcs' => ($totalxy + $totalysisa),
					'totalx' => $totalx,
					'totaly' => $totaly,
					'totalsisa' => $totalysisa,
			);
	}

	public function hargaPerPcs($paperID, $planoID)
	{
		$paperprice = Paper::leftjoin('paperdetails', 'paperID', '=', 'papers.id')
					->leftjoin('vendors', 'vendorID', '=', 'vendors.id')
					->where('papers.id', '=', $paperID)
					->where('planoID', '=', $planoID)
					->where('unittype', '=', 'lembar')
					->select('vendors.id as vendorID', 'paperdetails.updated_at as updatetime',
							DB::raw('MIN(unitprice) as unitprice'))
					->groupBy('vendors.id', 'paperdetails.updated_at')
					->orderBy('paperdetails.updated_at', 'desc')
					->orderBy('unitprice', 'asc')
					->first();
		
		return $paperprice['unitprice'];

		// if(count($paperprice) == 0) 
		//     return 0;
		// else
		// {
		//     $hperkg = $paperprice[0]['unitprice'];
		//     return $hperkg;
		// }
	}

	public function hargaPerRim(Array $data, $paperID, $planoID)
	{
		$hperpcs = $this->hargaPerPcs($paperID, $planoID);
		$data['paper']['hperpcs'] = floatval($hperpcs);
		$rimprice = intval(MathHelper::ceil($hperpcs * 500, 1));
		$data['paper']['hperrim'] = floatval($hperpcs);
		return $rimprice;
	}

	public function hargaKertas(Array $data, $totalinprint, $totalinplano, $qty, $inschiet, $paperID, $planoID)
	{
		$hperrim = $this->hargaPerRim($data, $paperID, $planoID);
		$totaldruct = intval(MathHelper::ceil(($qty / $totalinprint) + $inschiet, 1));
		$totalplano = intval(MathHelper::ceil($totaldruct / $totalinplano, 1));
		$totalrim = floatval(($totalplano) / 500);
		$hargakertas = intval(MathHelper::ceil($totalrim * $hperrim, 1));

		$data['paper']['totaldruct'] = $totaldruct;
		$data['paper']['totalplano'] = $totalplano;
		$data['paper']['totalrim'] = $totalrim;

		return MathHelper::ceil($hargakertas, 10000);
	}

	public function hargaCetak($paper, $qty, $inschiet, $hperdruct, $minim1000, $sdp, $hargaPerPlat)
	{
		$percetak = $paper['totalinprintx'] * $paper['totalinprinty'];
		$totaldruct = MathHelper::ceil(($qty / $percetak) + $inschiet, 25);
		$hargaminim = $minim1000 * 4; // 4 WARNA

		if($sdp == 2)
		{
			if($percetak >= 1)
			{
				if($percetak % 2 == 0)
				{
					//BISA KONTRAFORM / BALIK BAKUL, CETAK 4 PLAT
					// cetak 1x

					$sisa = ($totaldruct * 2) - 1000;
					$sisa = $sisa <= 0 ? 0 : $sisa;
					$hargasisa = $sisa * $hperdruct * 4; // cetak 2x, tapi cuma stel sekali

					$hargacetak = $hargasisa + $hargaminim;

					$hargaplat = $hargaPerPlat * 4;
					//$paper['mode'] = '2 SISI, 4 PLAT, KONTRAFORM';
				}
				else
				{
					//HARUS 8 PLAT, CTEAK 2x
					//$hargatotal *= 2;
					$hargaminim *= 2; // cetak 2x
					
					$sisa = $totaldruct - 1000;
					$sisa = $sisa <= 0 ? 0 : $sisa;
					$hargasisa = $sisa * $hperdruct * 4 * 2; // cetak 2x

					$hargacetak = $hargasisa + $hargaminim;
					$hargaplat = $hargaPerPlat * 8;
					//$paper['mode'] = '2 SISI, 8 PLAT, 2x CETAK';
				}
				$totaldruct *= 2;
				$paper['totaldruct2'] = $totaldruct;
			}
			else
			{
				//KALO ERROR $percetak = 0
				$hargacetak = 999999999;
				$hargaplat = 999999999;
				$paper['mode'] = 'ERROR';
			}
		}
		else
		{
			//UNTUK YANG CETAK 1SISI
			// cetak 1x

			$sisa = $totaldruct - 1000;
			$sisa = $sisa <= 0 ? 0 : $sisa;
			$hargasisa = $sisa * $hperdruct * 4; // cetak 1x

			$hargacetak = $hargasisa + $hargaminim;

			$hargaplat = $hargaPerPlat * 4;

			$paper['totaldruct2'] = $totaldruct;
			//$paper['mode'] = '1 SISI, 4 PLAT';
		}

		$hargatotal = $hargacetak + $hargaplat;
		
		return MathHelper::ceil($hargatotal, 10000);
	}

	public function hargaPlat($paper, $hperplat, $sdp)
	{
			$percetak = $paper['totalinprintx'] * $paper['totalinprinty'];
			//return $percetak%2;
			$ganjil = false;
			if ($sdp == 2) { // 2 sisi
					if ($percetak % 2 == 1) { // A3 <-- sekali cetak cuma 1
							$ganjil = true;
					} else { // jalan kontraform
							$ganjil = false;
					}
			}

			$hargaplat = $hperplat * 4;
			if ($sdp == 2){
					if($ganjil) $hargaplat = $hperplat * 8;
			}
			
		return $hargaplat;
	}

	public function hargaPerKg($paper, $qty, $inschiet, $hkg, $minimpotong)
	{
			$length = $paper['length'];
			$width = $paper['width'];
			$perplano = $paper['totalinplano'];
			$percetak = $paper['totalinprinty'] * $paper['totalinprintx'];
			$gramature = $paper['gramature'];

			$totaldruct = MathHelper::ceil(($qty / $percetak) + $inschiet, 25);

			$totalkertas = $length * $width / $perplano * $totaldruct;
			$totalberat = $totalkertas * $gramature / 20000 / 500;
			$totalberat = MathHelper::ceil($totalberat, 1);

			$hargapotong = $totalberat * $hkg;

			$paper['totalberat'] = $totalberat;

			if ($hargapotong < $minimpotong) return intval($minimpotong);
			else return MathHelper::ceil($hargapotong, 10000);
	}

	public function hargaPerKgMnl($gramature, $width, $length, $qty, $hkg, $minimpotong, $baseprice)
	{
		$totalberat = $qty * $width * $length * $gramature / 20000 / 500;
		$totalberat = MathHelper::ceil($totalberat, 1);
		$hargapotong = $totalberat * $hkg + $baseprice;

		$paper['totalberat'] = $totalberat;

		if ($hargapotong < $minimpotong) return $minimpotong;
		else return MathHelper::ceil($hargapotong, 10000);
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

	public function tambahBoxKartuNama(Array $data, $boxprice)
	{
		$data['total']['price'] += MathHelper::ceil($boxprice * $data['quantity'], 1000);
		return $data;
	}

	public function tambahKakiRollUp(Array $data)
	{
		return $data;
	}


}
