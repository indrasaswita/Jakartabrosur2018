<?php

namespace App\Logic\Utility;

use App\Helpers\MathHelper;
use App\Vendor;
use App\Papersize;

class Jobprintcutsticker extends Jobflyer{
	public function hitungPrint(){
		$this->setMaxPrint(28, 44);
		$this->hitungFlyer();
	}

	public function hitungCuttingA3(){
		$druct = $this->data['calculation']['totaldruct'];

		$machineID = 11;
		$unitprice = $this->hargaPerUnitDG($machineID, $druct);
		$totalprint = $unitprice * $druct;

		$this->texttoread .= "<i class='fas fa-chevron-right'></i> <b>CUTTING</b>: <span class='tx-purple'>".MathHelper::thseparator($totalprint)."</span> ( ".MathHelper::thseparator($druct)." lembar _@".MathHelper::thseparator($unitprice)." )<br>";

		$this->texttoread .= "<hr class='margin-5-0'>";

		$this->data['total']['cetakprice'] += $totalprint;
		$this->data['total']['price'] += $totalprint;
	}
}