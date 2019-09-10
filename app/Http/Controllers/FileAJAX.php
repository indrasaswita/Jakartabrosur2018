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

	public function downloadByFileID($id){
		$userid = session()->get('userid');
		if($userid == null)
			return null;


		$file = Files::where('id', '=', $id)
						->where('customerID', $userid)
						->with('customer')
						->with('cartfile')
						->first();

		$filename = 'File Asli '.$file['cartfile']['cartheader']['jobtitle'].'('.$file['cartfile']['cartheader']['jobsubtype']['name'].')-C'.sprintf("%04d", $file['cartfile']['cartheader']['id']).'-'.'F'.sprintf("%04d", $file['id']).'-'.substr($file['customer']['name'], 0, strpos($file['customer']['name'], ' ')).'-R'.$file['revision'].substr($file['path'], strpos($file['path'], '.'));

		return $this->publicDownloadByFileID($file, $userid, $filename);
	}

	public function downloadPreviewByFileID($id){
		$userid = session()->get('userid');

		$file = Files::whereHas('cartpreview', function($query) use ($userid){
				$query->whereHas('cartheader', function($query2) use ($userid){
						$query2->where('customerID', $userid);
				});
			})
			->where('id', $id)
			->first();
		if($file == null)
			return null;
		if($userid == null)
			return null;


		$file = Files::where('id', '=', $id)
						->with('cartpreview')
						->first();

		$filename = 'Proof-'.$file['cartpreview']['cartheader']['jobtitle'].'('.$file['cartpreview']['cartheader']['jobsubtype']['name'].')-R'.$file['revision'].substr($file['path'], strpos($file['path'], '.'));

		return $this->publicDownloadByFileID($file, $userid, $filename);
	}

	public function publicDownloadByFileID($file, $userid, $filename){

		if($file == null)
			return ["status"=>"error", 'data'=>"Wrong ID inputed"];
		else
		{
			$filepath = public_path().'/'.$file['path'];
			if(file_exists($filepath))
				return response()->download($filepath, $filename);
			else
				return ["status"=>"error", 'data'=>"FILE NOT EXISTS"];
		}
	}
}
