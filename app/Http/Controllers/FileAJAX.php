<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;

class FileAJAX extends Controller
{
	public function saveurl(Request $request){
		$data = $request->all();
		$url = $data['url'];
		$custID = session()->get('userid');

		if($url != null){
			if($custID != null){
				$nw = new Files();
				$nw->customerID = $custID;
				$nw->size = 0;
				$nw->filename = $url;
				$nw->path = $url;
				$nw->icon = 'image/ext-url.png';
				$nw->revision = 1;
				$nw->detail = '';

				$before = Files::doesnthave('cartfile')
						->where('customerID', $custID)
						->count();
				$nw->save();
				$after = Files::doesnthave('cartfile')
						->where('customerID', $custID)
						->with('customer')
						->get();

				if(count($after) == $before + 1){
					return $after;
				}
			}
		}

		return null;
	}

	public function savedetail(Request $request){
		$data = $request->all();
		$fileID = $data['fileID'];
		$detail = $data['detail'];
		$custID = session()->get('userid');

		if($custID == null)
			return null;

		$dt = Files::find($fileID);
		if($dt == null){
			return null;
		}else{
			$dt->detail = $detail;
			$dt->save();

			$dt = Files::doesnthave('cartfile')
					->where('customerID', $custID)
					->with('customer')
					->get();
			if($dt == null)
				return null;
			else
				return $dt;
		}
	}
}
