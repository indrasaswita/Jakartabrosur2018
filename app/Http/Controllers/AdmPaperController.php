<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paper;

class AdmPaperController extends Controller
{
    public function index(){
    	$papers = Paper::with('papertype')
    			->with('paperdetail')
    			->get();

    	return view('pages.admin.master.paper.index', compact('papers'));
    }
}
