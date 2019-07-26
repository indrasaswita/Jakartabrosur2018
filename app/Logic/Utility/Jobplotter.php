<?php

namespace App\Logic\Utility;

use App\Helpers\MathHelper;
use App\Vendor;
use App\Papersize;

class Jobplotter extends Job{

	protected $max_print_width;
	protected $bleedwidth = 0;
	protected $bleedlength = 0;
	protected $marginwidth = 6;
	protected $marginlength = 40;
	protected $machineID = 0;

	public function __construct($data, $constants){
		$this->data = $data;
		$this->cs = $constants;


		$this->max_print_width = 320; //cm
	}

	public function setMargin($bleedwidth, $bleedlength, $marginwidth, $marginlength){
		$this->bleedwidth = $bleedwidth;
		$this->bleedlength = $bleedlength;
		$this->marginwidth = $marginwidth;
		$this->marginlength = $marginlength;
	}

	public function setMachineID($id){
		$this->machineID = $id;
	}

	public function hitungPlotter(){
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

		$result = $this->calcPlanoSizeRoll($data, $imagewidth, $imagelength, $qty, $this->bleedwidth, $this->bleedlength, $this->marginwidth, $this->marginlength, $this->max_print_width, $paperID, $texttoread);

		if($result != null)
		{
			//kalo ukurannya ga ada, return null (status -> buat keluar dari calc per job)
			return $result;
		}

		//totalarea dalam cm -> ubah dalam m, karena d DB DI CATAT DALAM M
		$printprice = $this->hargaCetakPlotter($this->machineID, floatval($data['calculation']['totalarea']/10000), $texttoread);


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
					.MathHelper::round($calc['totalinplanox'], 0.001)
					."x"
					.MathHelper::round($calc['totalinplanoy'], 0.001)
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

		return null;
	}

}