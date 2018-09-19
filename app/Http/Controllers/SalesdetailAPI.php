<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesdetail;

class SalesdetailAPI extends Controller
{
  public function commit($id){
  	$item = Salesdetail::findOrFail($id);
  	if($item->commited != 0){
  		return null;
  	}else{
	  	$item->commited = 1;
	  	$item->save();
	  	$test = Salesdetail::findOrFail($id);
	  	if($test->commited == 1)
	  		return "success";
	  	else
	  		return null;
	  }
  }

  public function release($id){
  	$item = Salesdetail::findOrFail($id);
  	if($item->commited != 1){
  		return null;
  	}else{
	  	$item->commited = 0;
	  	$item->save();
	  	$test = Salesdetail::findOrFail($id);
	  	if($test->commited == 0)
	  		return "success";
	  	else
	  		return null;
	  }
  }
}
