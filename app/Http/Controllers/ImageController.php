<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Image\ImageRepository;
use App\Http\Requests;
use App\Cartfile;
use App\CartHeader;
use File;
use App\Files;

class ImageController extends Controller
{
	protected $image;

	public function __construct(ImageRepository $imageRepository)
	{
		$this->image = $imageRepository;
	}

	public function uploadPreview($id, Request $request)
	{
		$data = $request->all();
		//$length = count($photo['files']);
		$length = 0; // DEPRECATED
		//return array('photo'=>$photo['files'][0]->getClientOriginalName());

		//CEK DULU ID FILENYA ADA ATAU KAGAK
		$file = Files::find($id);

		if($file == null){
			//UNTUK PREVIEW harus ada data Filenya di DB.. kalo ga ada brarti ID salah
			return 'Source File Not Found - Error di Database Tidak Tersedia';
		}

		if (array_key_exists("files", $form_data))
		{
			//SAVE DATANYA buat 1 FILE doang, kalo mau banyak file harus looping
			$response = $this->image->uploadPreviewFile($id, $form_data['files'][0]);
		}

		//responsenya juga buat 1 data doang, kalo banyak data mesti pindah function
		if(strpos($response,'images/preview/')==0){
			$file->preview = $response;
			$file->save();

			return $response;
		}

		return "Not Saved!";
	}

	public function originalUploadCustomerByCart(Request $request, $cartid)
	{
		return $this->originalUploadEmployee($request, session()->get('userid'), $cartid);
	}

	public function originalUploadCustomer(Request $request)
	{
		//BY USER (CUSTOMER)

		$data = $request->all();

		//$length = 0; // DEPRECATED
		//dd($data['files'][0]);

		if (array_key_exists("files", $data))
		{
			$response = $this->image->upload($data['files'][0]);
			if($response instanceof Files)
			{
				$response->customerID = session()->get('userid');
				$response->save(); // jika response dalam bentuk Object Files
			}
			else
			{
				//jika response berupa kode error
				return $response;
			}
		}

		return $this->getPendingImage();
	}

	public function originalUploadEmployee(Request $request, $custid, $cartid)
	{
		//BY ADMIN (EMPLOYEE)

		$data = $request->all();
		//$length = count($photo['files']);
		$length = 0; // DEPRECATED
		//return array('photo'=>$photo['files'][0]->getClientOriginalName());
		if (array_key_exists("files", $data))
		{
			$response = $this->image->upload($data['files'][0]);
			if($response instanceof Files)
			{
				$response->customerID = $custid;
				$response->save(); // jika response dalam bentuk Object Files

				$file = Files::orderBy('id', 'desc')
								->first();
				$fileID = -1;
				if($file != null)
				{
					$fileID = $file['id'];
				}

				$cartfile = new Cartfile();
				$cartfile->fileID = $fileID;
				$cartfile->cartID = $cartid;
				$cartfile->save();
			}
			else
			{
				//jika response berupa kode error - string
				return $response;
			}
		}

		return $this->getCartFiles($cartid);
	}

	public function getCartfiles($cartID){
		$cartfiles = Cartfile::with('file')
								->where('cartID', '=', $cartID)
								->get();

		return $cartfiles;
	}

	public function getPendingImage(){
		$custID = session()->get('userid');
		$files = Files::leftjoin('cartfiles', 'cartfiles.fileID', '=', 'files.id')
			->whereNull('cartfiles.id')
			->where('customerID', '=', $custID)
			->select('files.*')
			->get();

		// $files = [];
		// if(session()->has('cartfile')) 
		// 	$files = session()->get('cartfile');

		// foreach ($last as $i => $item) {
		// 	array_push($files, $item); // MASUKIN SEMUA YANG DI LAST
		// }

		if(count($files)>0){
			//session()->put('cartfile', $files);
			return $files;
		}
		else{
			//session()->forget('cartfile');
			return null;
		}
	}


	public function deleteUpload(Request $request)
	{
		$id = $request->get(0);
		$file = Files::find($id);
		$path = $file['path'];
		$icon = $file['icon'];
		$preview = $file['preview'];
		if($file!=null)$file->delete();

		//UNTUK DELETE FILE DI STORAGE
		File::delete($path);
		File::delete($preview);
		if (strstr($icon, public_path("image/ext-")) != $icon) File::delete($icon);
		//------------------------------

		//$response = $this->image->delete( $filename );
		/*if(session()->has('cartfile')) $files = session()->get('cartfile');
		else $files = null;
		foreach ($files as $i=>$item) {
			if($item['id']==$id){
				unset($files[$i]);
			}
		}
		for ($i=0; $i < count($files); $i++) { 
			return $files;
			if($files[$i]['id'] == $id){
				unset($files[$i]);
			}
		}*/
		/*if(count($files)>0){
			session()->put('cartfile', $files);
			return $files;
		}
		else{
			session()->forget('cartfile');
			return '';
		}*/

		return $this->getPendingImage();
	}

	public function dzThrow(Request $request)
	{
		return "nothing";
	}
}
