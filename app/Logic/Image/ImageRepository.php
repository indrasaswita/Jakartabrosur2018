<?php

namespace App\Logic\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Cartfile;
use App\Files;
use App\UtilImage;
use Illuminate\Support\Facades\Cache;

class ImageRepository
{
	public function uploadImageOnly($photo)
	{
		$validator = Validator::make(
			[ 'files' => $photo ], 
			[ 'files' => 'mimes:jpeg,jpg,png,gif,tiff,tif|required|max:52428800'  ]
			//MAXIMUM 50MB
		);



		$file = new Files();

		$originalName = $photo->getClientOriginalName();
		$extension = $photo->getClientOriginalExtension();

		$originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

		$filename = $this->sanitizeFilename($originalNameWithoutExt);
		$allowed_filename = $this->createUniqueFilename( 'original', $filename, $extension );

		if(!$validator->fails())
		{
			//IMAGE
			$file->size = $file->getSize();
			$uploadSuccess1 = $this->original( $photo, $allowed_filename );
			$uploadSuccess2 = $this->icon( $photo, $allowed_filename );

			if( !$uploadSuccess1 || !$uploadSuccess2 ) {

				return 'Server error while uploading';

			}
			$file->icon= "images/icon/".$allowed_filename;
		}
		else
		{
			return "File is not an image.. Failed to proceed..";
		}


		$file->path= "images/original/".$allowed_filename;
		$file->detail = "";
		$file->filename = $originalName;
		$file->revision = 1;
		return $file;
	}

	public function uploadSelective( $photo )
	{

		$validator = Validator::make(
			[ 'files' => $photo ], 
			[ 'files' => 'mimes:jpeg,jpg,png,gif,tiff,tif|required|image|max:104857600'  ]
			// MAXIMUM FILE 100MB
		);


		$file = new Files();

		$originalName = $photo->getClientOriginalName();
		$extension = $photo->getClientOriginalExtension();

		$originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

		$filename = $this->sanitizeFilename($originalNameWithoutExt);
		$allowed_filename = $this->createUniqueFilename( 'original', $filename, $extension );

		if(!$validator->fails())
		{		
			$file->size = $photo->getSize(); // GETSIZE HARUS SEBELOMM MOVE IMAGE

			$uploadSuccess1 = $this->original( $photo, $allowed_filename );
			$uploadSuccess2 = $this->icon( $photo, $allowed_filename );

			if( !$uploadSuccess2 ) {
				return 'Server error while uploading';
			}

			$file->icon = "images/icon/".$allowed_filename;
		}
		else
		{
			return " NON IMAGE ";
			$file->size = $photo->getSize(); // GETSIZE HARUS SEBELOM MOVE
			$photo->move(public_path("images/original/"), $allowed_filename);

			$file->icon= "image/ext-".$extension.'.png';
		}

		$file->path= "images/original/".$allowed_filename;
		//SAVE TO CACHE TO REFRESH THE LOADING BAR
		Cache::put('filepath', $file->path, 600);
		Cache::put('filesize', $file->size, 600);
		$file->detail = "";
		$file->filename = $originalName;
		$file->revision = 1;
		return $file;
	}

	/**
	 * Optimize Original Image
	 */
	public function original( $photo, $filename )
	{
		$manager = new ImageManager();
		//return public_path();
		$image = $manager->make( $photo )->save(public_path("images/original/".$filename));
		/*Config::get('images.full_size') . */

		return $image;
	}

	public function preview( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->save(public_path("images/preview/".$filename));
		/*Config::get('images.full_size') . */

		return $image;
	}

	/**
	 * Create Icon From Original
	 */
	public function icon( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->resize(50, null, function ($constraint) {
			$constraint->aspectRatio();
			})
			->save(public_path("images/icon/".$filename));
		/*Config::get('images.icon_size')  .*/

		return $image;
	}

	/**
	 * Delete Image From Session folder, based on original filename
	 */
	public function delete ($originalFilename)
	{

		$full_size_dir = Config::get('images.full_size');
		$icon_size_dir = Config::get('images.icon_size');

		$sessionImage = Image::where('original_name', 'like', $originalFilename)->first();


		if(empty($sessionImage))
		{
			return Response::json([
				'error' => true,
				'code'  => 400
			], 400);

		}

		$full_path1 = $full_size_dir . $sessionImage->filename;
		$full_path2 = $icon_size_dir . $sessionImage->filename;

		if ( File::exists( $full_path1 ) )
		{
			File::delete( $full_path1 );
		}

		if ( File::exists( $full_path2 ) )
		{
			File::delete( $full_path2 );
		}

		if( !empty($sessionImage))
		{
			$sessionImage->delete();
		}

		return Response::json([
			'error' => false,
			'code'  => 200
		], 200);
	}


	public function sanitizeFilename($string, $force_lowercase = true, $anal = false)
	{
		$strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
			"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
			"â€”", "â€“", ",", "<", ".", ">", "/", "?");
		$clean = trim(str_replace($strip, "", strip_tags($string)));
		$clean = preg_replace('/\s+/', "-", $clean);
		$clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

		return ($force_lowercase) ?
			(function_exists('mb_strtolower')) ?
				mb_strtolower($clean, 'UTF-8') :
				strtolower($clean) :
			$clean;
	}

	public function createUniqueFilename( $type, $filename, $extension )
	{
		//$full_size_dir = Config::get('images.full_size');
		$full_size_dir = public_path('images/'.$type.'/');
		$full_image_path = $full_size_dir . $filename . '.' . $extension;

		if ( File::exists( $full_image_path ) )
		{
			// Generate token for image
			$imageToken = substr(sha1(mt_rand()), 0, 5);
			return $filename . '-' . $imageToken . '.' . $extension;
		}

		return $filename . '.' . $extension;
	}
}