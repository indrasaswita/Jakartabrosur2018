<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageAPI extends Controller
{
	public function getMaxFilesize(){
		return UploadedFile::getMaxFilesize();
	}
}
