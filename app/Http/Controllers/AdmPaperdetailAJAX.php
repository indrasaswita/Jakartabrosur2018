<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Papersize;
use App\Paperdetail;

class AdmPaperdetailAJAX extends Controller
{
	public function savenewplano(Request $request){
		$datas = $request->all();

		/*$$hashKey: "object:121"
		buyprice: 500000
		error: {size: null}
		inputprice: 500000
		inputstate: "pertotal"
		length: 100
		margin: 4
		paper: {id: 1, papertypeID: 1, name: "ArtPaper", color: "Putih", gramature: 100, …}
		sellprice: 520000
		totalpcs: 500
		unitprice: 1040
		unittype: {type: "lembar", $$hashKey: "object:123"}
		vendor: {id: 2, name: "Suryapalace Jaya", phone1: "0216249122", phone2: "0216249121", addressID: null, …}
		width: 65
		__proto__: Object*/

		foreach ($datas as $i => $ii) {
			if($ii['width']>$ii['length']){
				$temp = $ii['width'];
				$ii['width'] = $ii['length'];
				$ii['length'] = $temp;
			} // KALO WIDTH LEBIH GEDE DARI LENGTH
			$width = $ii['width'];
			$length = $ii['length'];

			//search planoID
			$plano = Papersize::where('width', $width)
					->where('length', $length)
					->first();

			if($plano == null){
				if($width<=$length){
					$nw = new Papersize();
					$nw->width = $width;
					$nw->length = $length;
					$nw->save();
					$last = Papersize::orderBy('id', 'desc')
						->first();
					if($last != null)
						$ii['planoID'] = $last['id'];
					else
						return "Error, TIDAK BISA SAVE Ukuran";
				}else{
					return "Error, Width > Length";
				}
			}else{
				$ii['planoID'] = $plano['id'];
			}

			$nw2 = new Paperdetail();
			$nw2->paperID = $ii['paper']['id'];
			$nw2->vendorID = $ii['vendor']['id'];
			$nw2->planoID = $ii['planoID'];
			$nw2->buyprice = $ii['buyprice'];
			$nw2->sellprice = $ii['sellprice'];
			$nw2->unitprice = $ii['unitprice'];
			$nw2->totalpcs = $ii['totalpcs'];
			$nw2->unittype = $ii['unittype']['type'];
			$nw2->available = 1;
			$nw2->save();

			return $plano;
		}
			

		return $datas;
	}
}
