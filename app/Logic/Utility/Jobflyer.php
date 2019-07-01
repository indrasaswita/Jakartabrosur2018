<?php

namespace App\Logic\Utility;

use App\Helpers\MathHelper;

class Jobflyer extends Job
{

	public function __construct($data, $constants){
		$this->data = $data;
		$this->cs = $constants;
	}

	public function setMaxPrint($width, $length){
		$this->max_print_width = $width;
		$this->max_print_length = $length;
	}

	public function hitungFlyer (){
		$data = $this->data;

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

		$printtype = $data['printtype'];

		if($printtype == "OF")
		{
			$inschiet = floatval($this->cs['InschietSM52']);
			$hperplat = $this->cs['BiayaPlatSM52'];
			$minim1000 = $this->cs['OngkosCetakMinimSM52'];
			$hperdruct = $this->cs['OngkosCetakSisaSM52'];

			//KALO SM52
			$marginlength = 0.8; // dalam cm
			$marginwidth = 0.4; // dalam cm
			$this->max_print_length = $this->max_print_length==0?51:$this->max_print_length;
			$this->max_print_width = $this->max_print_width==0?36:$this->max_print_width;
			$bleed = 0.4;
			$jepitan = 1.0;
		}
		else if($printtype == 'DG')
		{
			/*$inschiet = 0;
			$hperplat = 0;
			$minim1000 = 0;
			$hperdruct = 0;*/

			$marginwidth = 0.5;
			$marginlength = 0.5;
			$this->max_print_length = $this->max_print_length==0?48.5:$this->max_print_length;
			$this->max_print_width = $this->max_print_width==0?33:$this->max_print_width;
			$bleed = 0.4;
			$jepitan = 0;
		}


		//CALC PLANO SIZE
		$paperID = $data['paperID'];
		$sdp = $data['sideprint'];
		$qty = $data['quantity'];
		$imagewidth = $data['size']['width'];
		$imagelength = $data['size']['length'];
		//$printtype = $data['printtype']; //uda di atas
		$data = $this->calcPlanoSize($data, $imagewidth, $imagelength, $qty, $sdp, $inschiet, $minim1000, $hperdruct, $bleed, $jepitan, $hperplat, $marginwidth, $marginlength, $this->max_print_width, $this->max_print_length, $paperID, $printtype);
		//hasilnya di store di $data['paper'] & ['calculation']


		$price = 0; // INIT HARGA
		$paper = $data['paper'];
		$calc = $data['calculation'];

		$paperprice = $calc['totalpaperprice'];
		//di set sebelumnya di calcPlanoSize (pas looping cari kertas yang pas)
		$printprice = $calc['totalprintprice'];
		//di set sebelumnya di calcPlanoSize (pas looping cari kertas yang pas)
		$totalprice = $calc['totalprice'];



		$paper = $data['paper'];
		$calc = $data['calculation'];

		$paper['planowidth'] = floatval($paper['planowidth']);
		$paper['planolength'] = floatval($paper['planolength']);
		$calc['inschiet'] = floatval($calc['inschiet']);
		$paper['hperpcs'] = floatval($paper['hperpcs']); //DELETE!

		$data['total'] = array(
			"disc"=>0,
			"price"=>$totalprice,
			"paperprice"=>$paperprice,
			"cetakprice"=>$printprice,
			"finishingprice"=>0,
		);

		$this->data = $data;
	}


}
	

