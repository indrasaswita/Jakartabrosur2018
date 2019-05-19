<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Aicesales;
use App\Icecream;
use DB;
use App\Http\Requests;

class AiceAPI extends Controller
{
	public function saveCart(Request $input){
		$data = $input->all();

		foreach ($data as $i => $ii) {
			$nw = new Aicesales;
			$nw->icecreamID = $ii['id'];
			$nw->sellprice = $ii['sellprice'];
			$nw->qty = $ii['qty'];

			$aice = Icecream::findOrFail($ii['id']);
			$aice->stock = $aice->stock - $ii['qty'];
			$aice->save();

			$nw->save();
		}

		return "success";
	}

	public function getSales(){
		$aicesales = Aicesales::with('icecream')->orderBy('id', 'desc')->get();
		return $aicesales;
	}

	public function getSalesGroup(){
		$aicesalesgroup = Aicesales::with('icecream')
				->select('id', 'icecreamID', DB::raw('SUM(qty) as qty'))
				->groupBy('icecreamID')
				->orderBy('icecreamID')->get();

		return $aicesalesgroup;
	}

	public function getAllAice(){
		$allaice = Icecream::where('minstock', '<>', '-1')->get();
		return $allaice;
	}

	public function updateAice(Request $request){
		$data = $request->all();
		foreach ($data as $i => $ii) {
			$temp = null;
			$temp = Icecream::where('id', '=', $ii['id'])->update(['stock'=>$ii['stock2'], 'minstock'=>$ii['minstock2'], 'sellprice'=>$ii['sellprice2']]);
		}
		return $this->getAllAice();
	}
}
