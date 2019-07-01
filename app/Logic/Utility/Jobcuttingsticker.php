<?php

namespace App\Logic\Utility;

use App\Helpers\MathHelper;
use App\Vendor;
use App\Papersize;

class Jobcuttingsticker extends Jobplotter{

	public function __construct($data, $constants){
		$this->data = $data;
		$this->cs = $constants;


		$this->max_print_width = 160; //cm
	}

	public function hitungCutting(){
		$data = $this->data;
		$texttoread = ""; // tampungan cuma buat yang kalkulasi di tengah2

		if( $data['size']['width'] < $data['size']['length'] ){
			$temp = $data['size']['width'];
			$data['size']['width'] = $data['size']['length'];
			$data['size']['length'] = $temp;
		}

		$paperID = $data['paper']['id'];
		$imagewidth = $data['size']['width']; //size width dalam cm
		$imagelength = $data['size']['length']; //size length dalam cm

		$qty = $data['quantity'];

		$data = $this->calcPlanoSizeRoll($data, $imagewidth, $imagelength, $qty, $this->bleedwidth, $this->bleedlength, $this->marginwidth, $this->marginlength, $this->max_print_width, $paperID, $texttoread);

		//totalarea dalam cm -> ubah dalam m, karena d DB DI CATAT DALAM M
		$printprice = $this->calcCuttingPriceRoll($this->machineID, floatval($data['calculation']['totalarea']/10000), $texttoread);


		//print_r($data);
		//BUAT TEXT TO READ
		$vendor = Vendor::findOrFail($data['paper']['vendorID']);
		$plano = Papersize::findOrFail($data['paper']['planoID']);
		$this->texttoread .= "<b>".$data['paper']['name']." ".($data['paper']['gramature']==0?"":$data['paper']['gramature']."g ")."</b><i class='tx-primary'>".$vendor['name']."</i> <br>";

		$calc = $data['calculation'];

		$this->texttoread .= "Perplano: <b>".
					MathHelper::thseparator(MathHelper::ceil($data['paper']['totalplano'], 1))
					."</b> ("
					.MathHelper::thseparator($data['paper']['totalplano'])
					.") roll<br>";
		$this->texttoread .= "Susunan: <b>"
					.$calc['totalinplano']
					."</b> pcs ("
					.$calc['totalinplanox']
					."x"
					.$calc['totalinplanoy']
					."+"
					.$calc['totalinplanorest']
					.")<br>";

		$this->texttoread .= "Ukuran Cetak: ".MathHelper::thseparator($plano['width'])." x ".MathHelper::thseparator($plano['length'])." cm<br>";	

		$this->texttoread .= "Percetak: <b>"
					.$calc['totalinprint']
					."</b> pcs<br>";

		$this->texttoread .= "Ukuran Cetak: ".MathHelper::thseparator($calc['printwidth'])." x ".MathHelper::thseparator($calc['printlength'])." cm<br>";					


		$this->texttoread .= "<br><div class='text-bold'>KALKULASI HARGA</div>";
		$this->texttoread .= "<hr class='margin-5-0'>";

		$this->texttoread .= $texttoread;

		
		$data['calculation']['totalprintprice'] = $printprice;
		$data['total']['cetakprice'] = $printprice;

		//BELOM DI JUMLAHIN CETAK SAMA PAPER
		$data['total']['price'] += $printprice;


		$this->data = $data;
	}

	public function calcCuttingPriceRoll($machineID, $totalarea, &$texttoread){
		$unitprice = $this->hargaPerUnitDG($machineID, MathHelper::ceil($totalarea, 0.1)); // Plotter Indoor 5pL
		// diatas percm2
		$unitprice *= 10000;

		$printprice = MathHelper::ceil(MathHelper::ceil($totalarea, 0.0001) * $unitprice, 1000); //unitprice percm2, totalarea perm2

		$texttoread .= "Per-m&sup2;: <span class='tx-purple'>".MathHelper::thseparator($unitprice)."</span> x <span class='tx-purple'>".MathHelper::ceil($totalarea, 0.0001)."</span> m&sup2;<br>";
		$texttoread .= "<i class='fas fa-chevron-right'></i> <b>PRINT</b>: <span class='tx-purple'>".MathHelper::thseparator($printprice)."</span><br>";
		$texttoread .= "<hr class='margin-5-0'>";

		return $printprice;
	}

}