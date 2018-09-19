<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paper;

class PaperAPI extends Controller
{
    public function apiGetAll(){
    	$papers = Paper::all();
    	return $papers;
    }
}
