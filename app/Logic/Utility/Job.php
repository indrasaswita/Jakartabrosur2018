<?php

namespace App\Logic\Utility;

use App\Paper;
use App\Paperdetail;
use App\Finishing;
use App\Helpers\MathHelper;
use App\Printingdigitalprice;
use DB;
use App\Vendor;

class Job
{
	protected $cs = null;
	protected $data = null;
	protected $calculation = null;
	protected $texttoread = "";
	protected $multipledetail = false;
	protected $max_print_length = 0;
	protected $max_print_width = 0;
	protected $textcombination = "";

	public function print(){
		dd($this->data);
	}

	public function getData(){
		return $this->data;
	}

	public function getTexttoread(){
		return $this->texttoread;
	}

	public function getTextcombination(){
		return $this->textcombination;
	}

	public function getUkuranByPaperID($paperID){
		$paperdetails =  Paperdetail::with('plano')
				->where('paperID', '=', $paperID)
				->where('available', '=', '1')
				->select(DB::raw('DISTINCT planoID, paperID'))
		//TANPA VendorID jadi hasilnya tidak tergantung search vendor
		//NANTI SELECT vendornya ada di function hargaPerRim
				->get(); 
		// CEK YANG SEJENIS (WARNA, GRAM, NAMA)

		return $paperdetails;
	}

	public function calcCombinationByMachineDG($imagelength, $imagewidth, $bleed, $sdp, $printwidth, $printlength){
		$combination = [];


		if($printlength < $printwidth){
			$temp = $printlength;
			$printlength = $printwidth;
			$printwidth = $temp;
		}

		if($printlength > $this->max_print_length)
			$printlength = $this->max_print_length;
		if($printwidth > $this->max_print_width)
			$printwidth = $this->max_print_width;

		//CARA 1
		$hasil2 = $this->getTotalInConstantPaper($imagelength, $imagewidth, $printlength, $printwidth, $bleed); 	

		//CARA 2
		$hasil1 = $this->getTotalInConstantPaper($imagewidth, $imagelength, $printlength, $printwidth, $bleed);

		//RESULT
		//array($printlength, $printwidth, $i, $j, $total)

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

	public function getTotalInConstantPaper($imagelength, $imagewidth, $printlength, $printwidth, $bleed){
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

	public function calcCombinationByMachine($imagelength, $imagewidth, $bleed, $jepitan, $max_print_length, $max_print_width, $sdp, $marginlength, $marginwidth){
		// BENTUKNYA BRUTE FORCE (1-10)
		$combination = [];
		$calctemp = [];
		$jj = [];

		$max_count_length = $max_count_width = 50;

		for ($i=$max_count_length; $i>0; $i--){ 
			for ($j=1; $j<=$max_count_width; $j++){ 

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

				//TUKER
				if ($printlength < $printwidth) 
				{ 
					$temp = $printlength;
					$printlength = $printwidth;
					$printwidth = $temp;
				}

				//CEK MASUK MESIN 52 gak?
				if($printwidth <= $max_print_width)
				{
					//$this->textcombination .= "short ok, ";
					if($printlength < $max_print_length)
					{
						//$this->textcombination .= "long ok, ";
						if($printwidth > 12 && $printlength > 18){
							//$this->textcombination .= "smallsize ok, ";
							if(abs($printlength - $printwidth) < 3){
							 if($printlength > 25 && $printwidth > 25){ // kalo kotak
									$textcombination = "_".$printwidth."x".$printlength." -> kotak>25 -> ";
									$calctemp = array($printwidth, $printlength, $j, $i, $i*$j, $textcombination);
								}
								else{
									//$this->textcombination .= "square < 25";
								}
							}
							else{
								$textcombination = "_".$printwidth."x".$printlength." -> p.panjang -> ";
									$calctemp = array($printwidth, $printlength, $j, $i, $i*$j, null, $textcombination);
							}
						}
						else
						{
							//$this->textcombination .= "smallsize fail.";
						}
					}
					else{
						//$this->textcombination .= "long fail.";
					}
				}
				else{
					//$this->textcombination .= "short fail.";
				}
				//$this->textcombination .= "<br>";
				/*else if($printwidth < $max_print_length && $printwidth > 18)
				{
					$this->textcombination .= "short:".$printlength."xlong:"$printwidth;

					if($printlength < $max_print_width && $printlength > 12)
					{
						if(abs($printlength - $printwidth) < 3 && $printlength > 25 && $printwidth > 25){ // kalo kotak
							$calctemp = array($printlength, $printwidth, $j, $i, $i*$j);
						}
					}
				}*/
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

	public function hitungPanjangRoll($qty, $usedwidth, $usedlength, $marginwidth, $marginlength, $planosizes)
	{
		/*
			return Array (leftqty, rightqty, usedrolllength, max_roll_width)
			*/
		$combinations = array();

		foreach ($planosizes as $i => $planosize) {

			//$maxitems : jumlah items ke samping
			$maxitems = MathHelper::floor(($planosize['plano']['width']-$marginwidth)/$usedlength, 1);

			for ($i=0; $i <= $maxitems; $i++) { 
				$lebaryangkepake = $i * $usedlength;
				$sisadalamcm = ($planosize['plano']['width']-$marginwidth) - $lebaryangkepake;
				$sisaitems = MathHelper::floor($sisadalamcm / $usedwidth, 1);

				$q1 = $i; //quantity 1 baris, kiri (utama)
				$q2 = $sisaitems; //quantity 1 baris, kanan (sisa)
				$totalusedlength = $q1 * $usedlength;
				$totalusedwidth = $q2 * $usedwidth;
				if($totalusedwidth + $totalusedlength != 0 &&
				 ($q1 >= 0 && $q2 >= 0))
				{
					$temp = $this->hitungPorsiCetak($qty, $totalusedwidth, $totalusedlength);
					$totalkiri = $temp[0]; 
					//total qty di kiri (0)
					$totalkanan = $temp[1];
					//total qty di kanan (1)

					if($q1!=0){
						//hitung panjang yang di pake di UTAMA
						$panjangkiri = MathHelper::ceil($totalkiri / $q1, 1) * $usedwidth;
					}
					else{
						//kalo ga ada di flag -1
						$panjangkiri = -1;
					}

					if($q2!=0){
						//hitung panjang yang di pake di SISA
						$panjangkanan = MathHelper::ceil($totalkanan / $q2, 1) * $usedlength;
					}
					else{
						//kalo ga ada di flag -1
						$panjangkanan = -1;
					}

					$panjangroll = 0; // init
					if($panjangkiri < 0){
						//kalo yang utamanya ga ada
						$panjangroll = $panjangkanan;
						//langsung di set yang SISA
					}
					else if($panjangkanan < 0){
						//kalo yang SISAnya ga ada
						$panjangroll = $panjangkiri;
						//langsung di set yang UTAMA
					}
					else
					{
						if ($panjangkiri > $panjangkanan){
							//kalo yang UTAMA lebih panjang
							$panjangroll = $panjangkiri;
						}
						else{
							//kalo yang SISA lebih panjang
							$panjangroll = $panjangkanan;
						}
					}
					$panjangroll += $marginlength;

					$banyakroll = floatval($panjangroll) / floatval($planosize['plano']['length']);

					$temp2 = array($q1, $q2, $panjangroll, $planosize['plano']['width'], $planosize['planoID'], $banyakroll, $totalkiri, $totalkanan);
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

		$lengthtotalportion = MathHelper::round($lengthportion * $qty, 1); //utamanya yang kiri
		$widthtotalportion = MathHelper::round($widthportion * $qty, 1); //sisanya yang kanan

		if($lengthtotalportion + $widthtotalportion > $qty)
			$widthtotalportion--;
		else if($lengthtotalportion + $widthtotalportion < $qty)
			$lengthtotalportion++;

		return array($lengthtotalportion, $widthtotalportion);
	}

	public function calcPlanoSizeRoll(Array $data, $imagewidth, $imagelength, $qty, $bleedwidth, $bleedlength, $marginwidth, $marginlength, $max_print_width, $paperID, &$texttoread)
	{
		if($imagelength < $imagewidth){
			$temp = $imagelength;
			$imagelength = $imagewidth;
			$imagewidth = $temp;
		}

		//$max_roll_width = array(90, 127, 152);
		$usedwidth = $imagewidth + $bleedwidth;
		$usedlength = $imagelength + $bleedlength;

		$planosizes = Paperdetail::with('plano')
				->where('paperID', '=', $paperID)
				->select('planoID', 'paperID')
				->whereIn('planoID', 
					function($query) use ($max_print_width){
						$query->from('papersizes')
							->where('width', '<=', $max_print_width)
							->select('id')
							->get();
					})
				->distinct()
				->get();

		$combinations = $this->hitungPanjangRoll($qty, $usedwidth, $usedlength, $marginwidth, $marginlength, $planosizes);

		$mostefficient = -1;
		$temp = [];
		foreach ($combinations as $i => $combination) {
			// index 2 = panjang yang di pake
			// index 3 = lebar roll yang di looping
			// [4] planoID ukuran bahan
			// [5] banyak roll yang kepake (totalplano)

			$totalarea = floatval($combination[2]) * floatval($combination[3]);
			if($mostefficient == -1 || $mostefficient > $totalarea){
				$mostefficient = $totalarea;
				$temp['totalarea'] = $totalarea;
				$temp = $combination;
			}
		}

		//ukuran area yang kepake ada di mostefficient -> DALAM CM
		$data['paper']['paperID'] = $data['paperID'];
		unset($data['paperID']);
		$data['calculation']['totalarea'] = $mostefficient;
		$data['calculation']['leftratio'] = $temp[0];
		$data['calculation']['rightratio'] = $temp[1];
		$data['calculation']['printlength'] = $temp[2]; // DALAM CM (yang kepake)
		$data['calculation']['printwidth'] = floatval($temp[3]); // DALAM CM (yang kepake = lebar bahan)
		$data['paper']['planoID'] = $temp[4];
		$data['paper']['totalplano'] = $temp[5];

		$data['calculation']['totaldruct'] = $data['quantity'];
		$data['calculation']['totalinplano'] = $temp[6];
		$data['calculation']['totalinplanox'] = $temp[0];

		$data['calculation']['totalinplanoy'] = ($temp[0]==0?0:$temp[6]/$temp[0]);
		$data['calculation']['totalinplanorest'] = $temp[7];
		$data['calculation']['totalinprint'] = 1;
		$data['calculation']['totalinprintx'] = 1;
		$data['calculation']['totalinprinty'] = 1;
		$data['calculation']['totalinprintrest'] = 0;

		$data['calculation']['inschiet'] = 0;
		$data['calcualtion']['doubleprintprice'] = 0;

		//ambil harga dari planoID
		$result = Paperdetail::where('paperID', $data['paper']['paperID'])
				->where('planoID', $temp[4])
				->orderBy('unitprice', 'asc')
				->first();


		$data['paper']['vendorID'] = $result['vendorID'];

		$paperprice = MathHelper::ceil(MathHelper::ceil($mostefficient/100/100, 0.5)*$result['unitprice'], 1000); //dihitung per1/2meter
		$data['calculation']['totalpaperprice'] = $paperprice;

		$texttoread .= "Area: <span class='tx-purple'>".MathHelper::ceil($mostefficient/10000, 0.5)."</span> m&sup2; ( <span class='tx-purple'>".MathHelper::thseparator($mostefficient)."</span> cm&sup2; )<br>";
		$texttoread .= "<i class='fas fa-chevron-right'></i> <b>BAHAN</b>: <span class='tx-purple'>".MathHelper::thseparator($paperprice)."</span> ( <span class='tx-purple'>@".MathHelper::thseparator($result['unitprice'])."</span> )<br>";
		$texttoread .= "<hr class='margin-5-0'>";


		//mostefficient dalam cm2
		//result['unitprice'] dalam m2
		$data['total'] = [
			'disc' => 0,
			'price' => $paperprice, //nanti di tambahin sama print price di luar
			'paperprice' => $paperprice,
			'cetakprice' => 0,
			'finishingprice' => 0
		];

		return $data;
	}

	public function calcPrintPriceRoll($machineID, $totalarea, &$texttoread){
		$unitprice = $this->hargaPerUnitDG($machineID, MathHelper::ceil($totalarea, 0.5)); // Plotter Indoor 5pL

		$printprice = MathHelper::ceil(MathHelper::ceil($totalarea, 0.5) * $unitprice, 1000);

		$texttoread .= "Per-m&sup2;: <span class='tx-purple'>".MathHelper::thseparator($unitprice)."</span> x <span class='tx-purple'>".MathHelper::ceil($totalarea, 0.5)."</span> m&sup2;<br>";
		$texttoread .= "<i class='fas fa-chevron-right'></i> <b>PRINT</b>: <span class='tx-purple'>".MathHelper::thseparator($printprice)."</span><br>";
		$texttoread .= "<hr class='margin-5-0'>";

		return $printprice;
	}

	public function calcPlanoSize(Array $data, $imagewidth, $imagelength, $qty, $sdp, $inschiet, $minim1000, $hperdruct, $bleed, $jepitan, $hperplat, $marginwidth, $marginlength, $max_print_width, $max_print_length, $paperID, $printtype, $detailindex=-1)
	{
		if($printtype == 'OF')
		{
			$combinations = $this->calcCombinationByMachine($imagelength, $imagewidth, $bleed, $jepitan, $max_print_length, $max_print_width, $sdp, $marginlength, $marginwidth);
		}
		else if($printtype == 'DG')
		{
			$printlength = 47;
			$printwidth = 31; // supaya bisa pake kertas 79 buat BW

			$combinations = $this->calcCombinationByMachineDG($imagelength, $imagewidth, $bleed, $sdp, $printwidth, $printlength);
		}


		//CARI UKURAN-UKURAN (result: array)
		$papers = $this->getUkuranByPaperID($paperID); //plano

		$themostefficient = 0; 
		// EFICIENT MULANYA DARI 0 <-- paling boros
		$thelowestprice = 9999999999;
		// PRICE MULAINYA DARI GEDE <-- paling boros
		$thispaper = [];

		//CARI KERTAS UKURAN YANG PALING EFISIEN
		// (UPDATED 2 : DICATAT DI TEXTTOREAD, yg terpilih di add di texttoread)
		foreach ($papers as $i => $paper) 
		{
			$planolength = floatval($paper['plano']['length']);
			$planowidth = floatval($paper['plano']['width']);
			foreach ($combinations as $j => $value) 
			{
				$printlength = $value[0];
				$printwidth = $value[1];
				$texttoread = "";

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


				//HARGA KERTAS
				$hargakertas = $this->hargaKertas($paper, $paper['totalinprint'], $paper['totalinplano'], $qty, $inschiet, $paperID, $paper['planoID'], $texttoread);
				/*if($data['printtype']=='OF')
					$hargakertas += 100000;*/
				


				//CEK HARGA TERMURAH
				if($printtype == 'OF')
				{
					$hargacetak = $this->hargaCetak($paper, $qty, $inschiet, $hperdruct, $minim1000, $sdp, $hperplat, $texttoread);

					$this->textcombination .= $value[6]."<b>".$planowidth."x$planolength belah ".$paper['totalinplano']."(".$paper['totalinplanox']."x".$paper['totalinplanoy']."+".$paper['totalinplanorest'].") belah ".$paper['totalinprint']."(".$paper['totalinprintx']."x".$paper['totalinprinty'].")"."</b> -> k".$hargakertas." + c".$hargacetak." = ".($hargacetak + $hargakertas)."<br>";
				}else if($printtype == 'DG'){
					$machineID = 5; // Konica A3
					$hargacetak = $this->hargaCetakDG($paper, $machineID, MathHelper::ceil($qty/$paper['totalinprint'], 1), $texttoread);

					$this->textcombination .= "_".$paper['printwidth']."".$paper['printlength']." -> <b>".$planowidth."x$planolength belah ".$paper['totalinplano']."(".$paper['totalinplanox']."x".$paper['totalinplanoy']."+".$paper['totalinplanorest'].") belah ".$paper['totalinprint']."(".$paper['totalinprintx']."x".$paper['totalinprinty'].")"."</b> -> k".$hargakertas." + c".$hargacetak." = ".($hargacetak + $hargakertas)."<br>";
				}

				$hargatotal = $hargacetak + $hargakertas;
				

				$paper['totalpaperprice'] = $hargakertas;
				//harga buat pergi ke indojaya
				$paper['totalprintprice'] = $hargacetak;
				$paper['totalprice'] = $hargatotal;
				$paper['texttoread'] = $texttoread;

				//EFISIEN DARI HARGA CETAK + KERTAS
				if ($hargatotal < $thelowestprice)
				{
					$thelowestprice = $hargatotal;

					$thispaper = clone $paper; 
					//KALO GA DI CLONE IKUT2AN sampe AKHIR
				}
			}
		}

		//KALO GA DI MASUKIN KE THISPAPER DULU, COLOR SAMA NAMENYA BAKAL ILANG
		$thispaper['color'] = $data['paper']['color'];
		$thispaper['name'] = $data['paper']['name'];
		$data['paper'] = $thispaper;


		//BUAT TEXT TO READ
		if(!$this->multipledetail) { // kalo ga ada multiple detail
			if(!isset($thispaper['vendorID'])) dd("TOKO KERTAS BELOM DI DAFTARIN, BELOM BISA DIPAKE");
			$vendor = Vendor::findOrFail($thispaper['vendorID']);

			$this->texttoread .= "<b>".$data['paper']['name']." ".$data['paper']['gramature']."g</b> -> ".$data['paper']['plano']['width']."x".$data['paper']['plano']['length']." <i class='tx-primary'>".$vendor['name']."</i> <br>";


			if($data['paper']['gramature'] != 0){
				$hperkg = (MathHelper::round(floatval($thispaper['hperpcs'])*20000*500/floatval($thispaper['gramature'])/floatval($data['paper']['plano']['width'])/floatval($data['paper']['plano']['length']), 100)/1000)."rb";
			}else{
				$hperkg = 0;
			}
			$this->texttoread .= "Perkg Rp <b>".$hperkg."</b> -> pcs <b>".$thispaper['hperpcs']."</b> <br>";

			$this->texttoread .= "Perplano: <b>"
						.$thispaper['totalinplano']
						."</b> pcs ("
						.$thispaper['totalinplanox']
						."x"
						.$thispaper['totalinplanoy']
						."+"
						.$thispaper['totalinplanorest']
						.")<br>";

			$this->texttoread .= "Percetak: <b>"
						.$thispaper['totalinprint']
						."</b> pcs ("
						.$thispaper['totalinprintx']
						."x"
						.$thispaper['totalinprinty']
						."+0)<br>";

			$printwidth = floatval(intval($thispaper['printwidth']*100)/100);
			$printlength = floatval(intval($thispaper['printlength']*100)/100);
			$this->texttoread .= "Uk. Kertas: <b>".$printwidth." </b>x<b> ".$printlength."</b>cm <br>";
			$this->texttoread .= "Uk. Gambar: <b>".$data['size']['width']."</b> x <b>".$data['size']['length']."</b>cm ";
			if($data['size']['name']!="Custom Size")
				$this->texttoread .= "(<b>".$data['size']['name']."</b>)";
			$this->texttoread .= "<br>Sisi cetak: <b>".$data['sideprint']." sisi</b><br><br>";

			$this->texttoread .= "<div class='text-bold'>KALKULASI HARGA</div>";
			$this->texttoread .= "<hr class='margin-5-0'>";

			//cetak kalkulasinya di bawah
			$this->texttoread .= $thispaper['texttoread'];

		}else if($this->multipledetail){
			//buat kalo yang banyak detail
			// kalender/buku/menu


			//print_r($data)


			$this->texttoread .= "<div><span class='tx-purple'>".($detailindex+1).". <b>".$data['detailname']."</b></span> <span class='pull-xs-right tx-lightgray'><b class='tx-purple'>".$data['multip']."</b> MODEL</span></div>";
			$this->texttoread .= "<hr class='margin-5-0'>";

			$vendor = Vendor::findOrFail($data['paper']['vendorID']);
			$this->texttoread .= "<b>".$data['paper']['name']." ".$data['paper']['gramature']."g</b> -> ".$data['paper']['plano']['width']."x".$data['paper']['plano']['length']." <i class='tx-primary'>".$vendor['name']."</i> <br>";

			if($data['paper']['gramature'] != 0){
				$hperkg = (MathHelper::round(floatval($data['paper']['hperpcs'])*20000*500/floatval($data['paper']['gramature'])/floatval($data['paper']['plano']['width'])/floatval($data['paper']['plano']['length']), 100)/1000)."rb";
			}else{
				$hperkg = 0;
			}
			$this->texttoread .= "Perkg Rp <b>".$hperkg."</b> -> pcs <b>".$data['paper']['hperpcs']."</b> <br>";

			$this->texttoread .= "Perplano: <b>"
						.$data['paper']['totalinplano']
						."</b> pcs ("
						.$data['paper']['totalinplanox']
						."x"
						.$data['paper']['totalinplanoy']
						."+"
						.$data['paper']['totalinplanorest']
						.")<br>";

			$this->texttoread .= "Percetak: <b>"
						.$data['paper']['totalinprint']
						."</b> pcs ("
						.$data['paper']['totalinprintx']
						."x"
						.$data['paper']['totalinprinty']
						.")<br>";

			$printwidth = floatval(intval($data['paper']['printwidth']*100)/100);
			$printlength = floatval(intval($data['paper']['printlength']*100)/100);
			$this->texttoread .= "Uk. Kertas: <b>".$printwidth." </b>x<b> ".$printlength."</b>cm <br>";
			$this->texttoread .= "Sisi cetak: <b>".$data['sideprint']." sisi</b><br>";

			$this->texttoread .= "<hr class='margin-5-0'>";

			$this->texttoread .= $thispaper['texttoread'];
		}


		//BENERIN DATA SESUAI NAMA
		$data['paper'] = [
			'planoID'=> $thispaper['planoID'],
			'paperID'=> $thispaper['paperID'],
			'vendorID'=> $thispaper['vendorID'],
			'planowidth'=> $thispaper['plano']['width'],
			'planolength'=> $thispaper['plano']['length'],
			'totalplano'=> $thispaper['totalplano'],
			'totalrim'=> $thispaper['totalrim'],
			'color'=> $thispaper['color'],
			'hperpcs'=> $thispaper['hperpcs'],
			'hperrim'=> $thispaper['hperrim'],
			'name'=> $thispaper['name'],
			'gramature'=> $thispaper['gramature'],
		];
		$data['calculation'] = [
			'totalinplanox'=> $thispaper['totalinplanox'],
			'totalinplanoy'=> $thispaper['totalinplanoy'],
			'totalinplano'=> $thispaper['totalinplano'],
			'totalinplanorest'=> $thispaper['totalinplanorest'],
			'totalinprintx'=> $thispaper['totalinprintx'],
			'totalinprinty'=> $thispaper['totalinprinty'],
			'totalinprint'=> $thispaper['totalinprint'],
			//'totalinprintrest'=> $thispaper['totalinprintrest'],
			'printlength'=> $thispaper['printlength'],
			'printwidth'=> $thispaper['printwidth'],
			'doubleprintprice'=> $thispaper['doubleprintprice'],
			'inschiet'=> $thispaper['inschiet'],
			'totaldruct'=> $thispaper['totaldruct'],
			'totalpaperprice'=> $thispaper['totalpaperprice'],
			'totalprintprice'=> $thispaper['totalprintprice'],
			'totalprice'=> $thispaper['totalprice'],
		];
		

		return $data;
	}

	public function hargaCetak($paper, $qty, $inschiet, $hperdruct, $minim1000, $sdp, $hargaPerPlat, &$texttoread="")
	{

		$percetak = $paper['totalinprintx'] * $paper['totalinprinty']; //+rest = 0
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
				$paper['totaldruct'] = $totaldruct;
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
			//tapi yang cetak 2 sisi masuk ke sini juga (BUG ERROR)
			//UNTUK YANG CETAK 1SISI
			// cetak 1x

			$sisa = $totaldruct - 1000;
			$sisa = $sisa <= 0 ? 0 : $sisa;
			$hargasisa = $sisa * $hperdruct * 4; // cetak 1x

			$hargacetak = $hargasisa + $hargaminim;

			$hargaplat = $hargaPerPlat * 4;

			$paper['totaldruct'] = $totaldruct;
			//$paper['mode'] = '1 SISI, 4 PLAT';
		}

		$hargatotal = $hargacetak + $hargaplat;


		$texttoread .= "Plat: <span class='tx-purple'>".MathHelper::thseparator($hargaplat)."</span> ( 4 x rp".MathHelper::thseparator($hargaPerPlat)." )<br>";
		$texttoread .= "Minim: <span class='tx-purple'>".MathHelper::thseparator($hargaminim)."</span> ( ".MathHelper::thseparator($totaldruct<1000?$totaldruct:1000)." lbr )<br>";
		$texttoread .= "Sisa: <span class='tx-purple'>".MathHelper::thseparator($hargasisa)."</span> ( ".MathHelper::thseparator($sisa==null?0:$sisa)." lbr )<br>";
		$texttoread .= "<i class='fas fa-chevron-right'></i> <b>PRINT</b>: <span class='tx-purple'>".MathHelper::thseparator($hargatotal)."</span><br>";

		$texttoread .= "<hr class='margin-5-0'>";
		
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

	public function hargaPerRim(&$paper, $paperID, $planoID)
	{
		$results = Paperdetail::with('plano', 'paper')
				->where('paperID', $paperID)
				->where('planoID', $planoID)
				->where('available', '1')
				->select('paperID', 'planoID', 'vendorID', 'unitprice')
				->get();
		//AMBIL DARI BBRP TOKO
		$lowest = $results->where('unitprice', $results->min('unitprice'))->first();
		//AMBIL dari TOKO YANG HARGAnya paling MURAH

		//isi paper di sini
		//planoID, paperID, totalinplanox, totalinplanoy, totalinplanorest, totalinplano, printlength, printwidth, totalinprintx, totalinprinty, totalinprint [[tidak ada totalinprintrest]], totalinprintprice, inchiet, totaldruct

		//$paper = clone $lowest; //TIDAK BOLEH
		$paper['vendorID'] = intval($lowest['vendorID']);
		$paper['plano']['width'] = intval($lowest['plano']['width']);
		$paper['plano']['length'] = intval($lowest['plano']['length']);
		$paper['color'] = $lowest['paper']['color'];
		$paper['gramature'] = $lowest['paper']['gramature'];
		//KIRIM DATA HASIL LOWEST KE $data['paper'] <= $paper

		$hperpcs = $lowest['unitprice'];
		$paper['hperpcs'] = floatval($hperpcs);
		$rimprice = intval(MathHelper::ceil($hperpcs * 500, 1));
		$paper['hperrim'] = floatval($rimprice);
		return $rimprice;
	}

	public function hargaKertas(&$paper, $totalinprint, $totalinplano, $qty, $inschiet, $paperID, $planoID, &$texttoread="")
	{

		$hperrim = $this->hargaPerRim($paper, $paperID, $planoID);
		$totalbersih = $qty / $totalinprint;
		$totaldruct = intval(MathHelper::ceil($totalbersih + $inschiet, 1));
		$totalplano = intval(MathHelper::ceil($totaldruct / $totalinplano, 1));
		$totalrim = floatval(($totalplano) / 500);
		$hargakertas = intval(MathHelper::ceil($totalrim * $hperrim, 1));

		$paper['totaldruct'] = $totaldruct;
		$paper['totalplano'] = $totalplano;
		$paper['totalrim'] = $totalrim;

		$texttoread .= "Bersih: <span class='tx-purple'>".MathHelper::thseparator($totalbersih)."</span> ( + <i>ins.</i> ".MathHelper::thseparator($inschiet)." ) <br>";
		$texttoread .= "Kotor: <span class='tx-purple'>".MathHelper::thseparator($totaldruct)."</span> druct <br>";
		$texttoread .= "Plano: <span class='tx-purple'>".MathHelper::thseparator($totalplano)."</span> ( ".MathHelper::thseparator($totalrim, 2)." rim ) <br>";

		$texttoread .= "<i class='fas fa-chevron-right'></i> <b>PAPER</b>: <span class='tx-purple'>".MathHelper::thseparator(MathHelper::ceil($hargakertas, 10000))."</span> ( ".MathHelper::thseparator($hargakertas)." )<br>";

		$texttoread .= "<hr class='margin-5-0'>";

		return MathHelper::ceil($hargakertas, 10000);
	}

	public function calcPaperPriceDigital($paperID, $totalpaperprint){
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

	public function hargaCetakDG(&$paper, $machineID, $qty, &$texttoread=""){
		$unitprice = $this->hargaPerUnitDG($machineID, $qty);
		$paper['printpriceeach'] = $unitprice;
		$totalprint = $unitprice * $qty;

		$texttoread .= "<i class='fas fa-chevron-right'></i> <b>PRINT</b>: <span class='tx-purple'>".MathHelper::thseparator($totalprint)."</span> ( ".MathHelper::thseparator($qty)." klik _@".MathHelper::thseparator($unitprice)." )<br>";

		$texttoread .= "<hr class='margin-5-0'>";

		return $totalprint;
	}

	public function hargaPerUnitDG($machineID, $qty){
		$qty = MathHelper::ceil($qty, 1);
		$unitprice = 0;

		$result = Printingdigitalprice::where('machineID', '=', $machineID)
				->orderBy('minqty', 'DESC')
				->where('minqty', '<=', $qty)
				->first();

		if($result!=null)
			$unitprice = $result['unitprice'];

		return $unitprice;
	}



	public function calcFinishing(&$texttoread=""){
		$data = $this->data;

		$this->subCalcFinishing($data, 'finishings', $data['paper']);

		if(!array_key_exists('price', $data['total'])){
			$data['total']['price'] = 0;
		}
		$data['total']['finishingprice'] = 0;

		$j=0;
		foreach ($data['finishings'] as $i => $ii) {
			$data['total']['price'] += $data['finishings'][$i]['totalprice'];
			$data['total']['finishingprice'] += $data['finishings'][$i]['totalprice'];


			$j++;
			$this->texttoread .= "<b class='tx-success'>".($j).".</b> ".$ii['finishing']['name'].": <span class='tx-purple'>".MathHelper::thseparator(floatval($data['finishings'][$i]['totalprice']))."</span><br>( <b>".$ii['option']['optionname']."</b> <span class='tx-lightgray'>@".MathHelper::thseparator(MathHelper::ceil($data['finishings'][$i]['totalprice']/$data['quantity'], 1))."</span> ) <br>";
		}


		$this->texttoread .= "<i class='fas fa-chevron-right'></i> <b>FINISHING</b>: <span class='tx-purple'>".MathHelper::thseparator($data['total']['finishingprice'])."</span>";
		$this->texttoread .= "<hr class='margin-5-0'>";
		
		$this->data = $data;
	} 

	public function subCalcFinishing(&$data, $finishingkey, $ppr, &$texttoread=""){

		
		//DARI DEPAN // UDA GA PERLU ADA YANG DI BUANG,ud steril dari Calculation.initDataFromDB (funct)	
		foreach ($data[$finishingkey] as $i => $ii) {
			$clc = $data['calculation'];


			$druct = $clc['totaldruct'];
			if($ii['finishingID']==26){
				$druct = 1;
			}

			//TRUS DI ITUNG KE TOTAL
			//$ppr = $data['paper'];
			if($ii['option']['priceper'] == "cm")
			{
				$data[$finishingkey][$i]['totalprice'] = MathHelper::ceil($clc['printwidth'] * $clc['printlength'] * $ii['option']['price'] * $druct, 1000) + $ii['option']['pricebase'];
				if($data[$finishingkey][$i]['totalprice'] < $ii['option']['priceminim'])
					$data[$finishingkey][$i]['totalprice'] = $ii['option']['priceminim'];
			}
			else if($ii['option']['priceper'] == "m")
			{
				$data[$finishingkey][$i]['totalprice'] = MathHelper::ceil($clc['printwidth'] / 100 * $clc['printlength'] / 100 * $ii['option']['price'] * $druct, 1000) + $ii['option']['pricebase'];
				if($data[$finishingkey][$i]['totalprice'] < $ii['option']['priceminim'])
					$data[$finishingkey][$i]['totalprice'] = $ii['option']['priceminim'];
			}
			else if($ii['option']['priceper'] == 'pcs')
			{
				$data[$finishingkey][$i]['totalprice'] = MathHelper::ceil($ii['option']['price'] * $druct, 1000) + $ii['option']['pricebase'];
				if($data[$finishingkey][$i]['totalprice'] < $ii['option']['priceminim'])
					$data[$finishingkey][$i]['totalprice'] = $ii['option']['priceminim'];
			}
			else if($ii['option']['priceper'] == "kg")
			{

				$temp = $this->hargaPerKgMnl($ppr['gramature'], $clc['printwidth'], $clc['printlength'], $druct, $ii['option']['price'], $ii['option']['priceminim'], $ii['option']['pricebase']);
				$data[$finishingkey][$i]['totalprice'] = $temp;

				//$temp = $this->hargaPotong($)
			}

		}

		return $data;
	}

}
	

