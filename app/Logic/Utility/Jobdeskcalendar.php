<?php

namespace App\Logic\Utility;

use App\Helpers\MathHelper;

class Jobdeskcalendar extends Jobflyer{
	public function __construct($data, $constants, $jobsubtype){
		$this->data = $data;
		$this->cs = $constants;
		$this->jobsubtype = $jobsubtype;
	}

	public function hitungKalender(){
		$this->multipledetail = true;
		$data = $this->data;

		unset($data['paper']);
		//paper ga di pake

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
			$max_print_length = 51;
			$max_print_width = 36;
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
			$max_print_length = 48.5;
			$max_print_width = 33;
			$bleed = 0.4;
			$jepitan = 0;
		}

		$qty = $data['quantity'];
		$imagewidth = $data['size']['width'];
		$imagelength = $data['size']['length'];

		$data['total'] = [
			'disc' => 0,
			'price' => 0,
			'paperprice' => 0,
			'cetakprice' => 0,
			'finishingprice' => 0
		];

		if($this->multipledetail){
			$this->texttoread .= "Ukuran: <span class='tx-purple'>".$data['size']['width']."</span> x <span class='tx-purple'>".$data['size']['length']."</span> cm ".(strlen($data['size']['name'])>0?"<br>Ukuran: [ <span class='tx-purple'>".$data['size']['name']."</span> ]":"")."</br>";
			$this->texttoread .= "<hr class='margin-5-0 bd-primary'>";
			$this->texttoread .= "<hr class='margin-5-0 bd-primary'>";
		}

		foreach ($data['jobsubtypedetail'] as $i => $detail) {
			$paperID = $detail['paper']['id'];
			$sdp = $detail['sideprint'];
			$multip = $detail['multip'];

			if($this->multipledetail){
				//kalo ada banyak detail index


				$detail = $this->calcPlanoSize($detail, $imagewidth, $imagelength, $qty*$multip, $sdp, $inschiet, $minim1000, $hperdruct, $bleed, $jepitan, $hperplat, $marginwidth, $marginlength, $max_print_width, $max_print_length, $paperID, $printtype, $i);
			}else{
				// kalo detail satuan
				$detail = $this->calcPlanoSize($detail, $imagewidth, $imagelength, $qty*$multip, $sdp, $inschiet, $minim1000, $hperdruct, $bleed, $jepitan, $hperplat, $marginwidth, $marginlength, $max_print_width, $max_print_length, $paperID, $printtype);
			}

			$data['calculation'][$i] = $detail['calculation'];
			$data['paper'][$i] = $detail['paper'];

			$data['total']['disc'] += 0;
			$data['total']['paperprice'] += $detail['calculation']['totalpaperprice'];
			$data['total']['cetakprice'] += $detail['calculation']['totalprintprice'];
			$data['total']['price'] += $detail['calculation']['totalprice'];

			//beda sama yang lain, kalo yang multiple job, pake finishing (SALAH DI JS)
			$this->subCalcFinishing($detail, 'finishing', $detail['paper']);



			$detail['calculation']['finishingprice'] = 0;
			if(count($detail['finishing'])>0){
				foreach ($detail['finishing'] as $j => $jj) {
					$detail['calculation']['finishingprice'] += $jj['totalprice'];

					//print_r($jj);
					$this->texttoread .= "<b class='tx-success'>".($j+1).".</b> ".$jj['finishingname'].": <span class='tx-purple'>".MathHelper::thseparator(floatval($jj['totalprice']))."</span> ( ".$jj['optionname']." ) <br>";
				}

				$this->texttoread .= "<i class='fas fa-chevron-right'></i> <b>FINISHING</b>: <span class='tx-purple'>".MathHelper::thseparator($detail['calculation']['finishingprice'])."</span>";
			} else {
				$this->texttoread .= "<div class='text-xs-center tx-gray'>NO FINISHING</div>";
			}
			$this->texttoread .= "<hr class='margin-5-0 bd-primary'>";
			$this->texttoread .= "<hr class='margin-5-0 bd-primary'>";

			$data['jobsubtypedetail'][$i] = $detail;

			if($i == 0)
			{
				$data['calculation']['totaldruct'] = $detail['calculation']['inschiet'] + $data['quantity'];
			}

			$data['total']['finishingprice'] += $detail['calculation']['finishingprice'];
			$data['total']['price'] += $detail['calculation']['finishingprice'];
		}


		$this->subCalcFinishing($data, 'finishings', $data['paper']);


		foreach ($data['jobsubtypedetail'] as $i => $detail) {
			$data['paper'][$i]['multip'] = $detail['multip'];
		}

		$data['paper']['gramature'] = $this->groupGramatures($data['paper']);

		$this->data = $data;
	}

	public function groupGramatures($papers){
		if(count($papers)==0)
			return 0;

		$totalgram = 0;
		foreach ($papers as $i => $paper) {
			$totalgram += $paper['gramature'] * $paper['multip'];
		}
		return $totalgram;
	}
}