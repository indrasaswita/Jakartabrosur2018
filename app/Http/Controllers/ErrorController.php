<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ErrorController extends Controller
{
    public function forbidden(){
    	return view('errors.forbidden');
    }

    public function notfound(){
    	return view('errors.notfound');
    }
}
