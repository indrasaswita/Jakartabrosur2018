<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Paperdetail;

class PaperdetailAPI extends Controller
{
    public function apiGetByPaperID($id){
    	$paperdetails = Paperdetail::where('paperID', '=', $id)
    			->get();
    	if($paperdetails == null)
    		return null;
    	else if(count($paperdetails)>0)
    		return $paperdetails;
    	else
    		return null;
    }

    public function apiGetVendorPlanoByPaperID($id){
    	$paperdetails = Paperdetail::with('vendor')
    			->with('plano')
    			->where('paperID', '=', $id)
    			->select('id', 'paperID', 'vendorID', 'planoID', 'unitprice')
    			->get();

			if($paperdetails == null)
    		return null;
    	else if(count($paperdetails)>0)
    		return $paperdetails;
    	else
    		return null;
    }
}
