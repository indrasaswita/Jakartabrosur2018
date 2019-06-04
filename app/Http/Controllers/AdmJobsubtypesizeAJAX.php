<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Size;
use App\Jobsubtypesize;

class AdmJobsubtypesizeAJAX extends Controller
{
	public function store(Request $request){
		$datas = $request->all();

		foreach ($datas as $i => $ii) {
			if($ii['sizeID'] == null){
				$nw = new Size();
				$nw->name = $ii['name'];
				$nw->width = $ii['width'];
				$nw->length = $ii['length'];
				$nw->shortname = '';
				$nw->save();

				$nw = null;
				$nw = Size::orderBy('id', 'desc')
						->first();
				if($nw != null){
					$ii['sizeID'] = $nw['id'];
				}
			}

			if($ii['sizeID'] != null){
				$nw = new Jobsubtypesize();
				$nw->jobsubtypeID = $ii['jobsubtypeID'];
				$nw->ofdg = $ii['ofdg'];
				$nw->sizeID = $ii['sizeID'];
				$nw->favourite = 0;
				$nw->save();
			}
		}

		return $datas;
	}
}
