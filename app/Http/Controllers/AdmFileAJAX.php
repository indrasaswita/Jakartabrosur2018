<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;

class AdmFileAJAX extends Controller
{
	public function downloadByFileID($id){


		$file = Files::where('id', '=', $id)
						->with('customer')
						->with('cartfile')
						->first();


		$filename = 'Ori_'.$file['cartfile']['cartheader']['jobtitle'].' ('.$file['cartfile']['cartheader']['jobsubtype']['name'].') '.substr($file['customer']['name'], 0, strpos($file['customer']['name'], ' ')).' - Revisi ke '.($file['revision']-1).substr($file['path'], strpos($file['path'], '.'));

		return $this->publicDownloadByFileID($file, $filename);
	}

	public function downloadPreviewByFileID($id){


		$file = Files::where('id', '=', $id)
						->with('cartpreview')
						->first();


		$filename = 'Proof_'.$file['cartpreview']['cartheader']['jobtitle'].'('.$file['cartpreview']['cartheader']['jobsubtype']['name'].') '.substr($file['cartpreview']['cartheader']['customer']['name'], 0, strpos($file['cartpreview']['cartheader']['customer']['name'], ' ')).'_'.substr($file['filename'], 0, 3).substr($file['path'], strpos($file['path'], '.'));

		return $this->publicDownloadByFileID($file, $filename);
	}

	public function publicDownloadByFileID($file, $filename){

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
