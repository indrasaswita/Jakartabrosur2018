<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UploadController extends Controller
{
    
    public function index()
    {
        if(session()->has('cartfile')) 
            $files = session()->get('cartfile');
        else $files = null;

        if (session()->has('flyerdata'))
            $data = session()->get('flyerdata');
        else $data = null;
        return view('pages.order.upload', compact('files', 'data'));
    }

}
