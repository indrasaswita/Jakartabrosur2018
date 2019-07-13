<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logic\Image\ImageRepository;
use App\Http\Requests;
use App\Cartfile;
use App\Cartpreview;
use App\CartHeader;
use File;
use App\Files;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageController extends Controller
{
	protected $image;

	public function __construct(ImageRepository $imageRepository)
	{
		$this->image = $imageRepository;
	}

	public function previewUploadEmployee(Request $request, $cartid)
	{
		//BY ADMIN (UPLOAD PROOF FILE)

		$data = $request->all();
		
		if (array_key_exists("files", $data))
		{
			$response = $this->image->uploadImageOnly($data['files'][0]);
			if($response instanceof Files)
			{
				//response ini file yang mau di input ke database
				$response->customerID = 1; // default buat employee // harusnya employeeID
				$response->save(); // jika response dalam bentuk Object Files

				$file = Files::orderBy('id', 'desc')
								->first();
				$fileID = -1;
				if($file != null)
				{
					$fileID = $file['id'];
				}

				$cartpreview = new Cartpreview();
				$cartpreview->fileID = $fileID;
				$cartpreview->cartID = $cartid;
				$cartpreview->commit = 0;
				$cartpreview->save();
			}
			else
			{
				//jika response berupa kode error - string
				return $response;
			}
		}
		else{
			return "File is not found.. Error from code, need to be resolved by Admin, call us ASAP..";
			//KALO DATA FILENYA GA ADA
		}

		return $this->getCartPreviews($cartid);
	}

	public function originalUploadCustomerByCart(Request $request, $cartid)
	{

		return $this->originalUploadEmployee($request, session()->get('userid'), $cartid);
	}

	public function originalUploadCustomer(Request $request)
	{
		//dd(phpinfo());
		//BY USER (CUSTOMER)

		$data = $request->all();

		//$length = 0; // DEPRECATED
		//dd($data['files'][0]);

		if (array_key_exists("files", $data))
		{
			$response = $this->image->uploadSelective($data['files'][0]);
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
		else{
			return "File is not found.. Error from code, need to be resolved by Admin, call us ASAP..";
			//KALO DATA FILENYA GA ADA
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
			$response = $this->image->uploadSelective($data['files'][0]);
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

	public function getCartpreviews($cartID){
		$cartpreviews = Cartpreview::with('file')
				->where('cartID', '=', $cartID)
				->get();

		return $cartpreviews;
	}

	public function getPendingImage(){
		$custID = session()->get('userid');
		
		$files = Files::doesnthave('cartfile')
			->with('customer')
			->where('customerID', $custID)
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
		//File::delete($preview);
		if (strstr($icon, "image/ext-") != $icon) File::delete($icon);
		//------------------------------


		return $this->getPendingImage();
	}


}
