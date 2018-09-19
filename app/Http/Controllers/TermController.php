<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TermController extends Controller
{
    public function index()
    {
    	return view('pages.terms.index');
    }
}
