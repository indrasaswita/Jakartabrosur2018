<?php


namespace App\Logic\Utility;

use App\Helpers\MathHelper;

class Jobbusinesscard extends Jobflyer{

	public function __construct($data, $constants){
		$this->data = $data;
		$this->cs = $constants;
	}


	public function tambahBoxKartuNama($boxprice)
	{
		$data = $this->data;

		$totalboxprice = MathHelper::ceil($boxprice * $data['totalbox'], 1000);
		$data['total']['price'] += $totalboxprice;

		$this->texttoread .= "<br>".$data['totalbox']." box: <span class='tx-purple'>".MathHelper::thseparator($totalboxprice)."</span> <br>";
		$this->texttoread .= "Total: <span class='tx-purple'>".MathHelper::thseparator($data['total']['price'])."</span> <br>";

		$this->data = $data;
	}

}