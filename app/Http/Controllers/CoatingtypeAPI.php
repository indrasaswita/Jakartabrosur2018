<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coatingtype;

class CoatingtypeAPI extends Controller
{
	public function getAll(){
		$coatingtypes = Coatingtype::all();
		return $coatingtypes;
	}
}
