<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Icecream;
use App\Aicesales;
use DB;
use App\Http\Requests;

class AiceController extends Controller
{
    public function index(){
    	$aice = Icecream::where('minstock', '<>', '-1')->get();
    	$aicesales = Aicesales::with('icecream')->orderBy('id', 'desc')->get();
    	$aicesalesgroup = Aicesales::with('icecream')
    										->select('id', 'icecreamID', DB::raw('SUM(qty) as qty'))
    										->groupBy('icecreamID')
    										->orderBy('icecreamID')->get();

    	return view('pages.others.aice.index', compact('aice', 'aicesales', 'aicesalesgroup'));
    }
}
