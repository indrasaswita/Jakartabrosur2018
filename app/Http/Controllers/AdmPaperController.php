<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paper;

class AdmPaperController extends Controller
{
    public function changeprice(){
    	$papers = Paper::with('papertype')
    			->with('paperdetail')
    			->get();

    	return view('pages.admin.master.paper.changeprice', compact('papers'));
    }

    public function newpaper(){
    	$papers = Paper::with('papertype')
    			->with('paperdetail')
    			->with('coatingtype')
    			->get();

    	$papers->makeVisible(['texture', 'numerator', 'varnish', 'spotuv', 'laminating', 'folding', 'perforation', 'diecut', 'coatingtypeID']);

    	return view('pages.admin.master.paper.newpaper', compact('papers'));
    }
}
