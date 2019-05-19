<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartpreview;
use DB;

class CartpreviewAPI extends Controller
{
  public function acceptfile($id){
  	$item = Cartpreview::findOrFail($id);
  	//tidak bisa di lakukan bila sudah accepted ATAU rejected
  	if($item->commit==1 || 
  		$item->commit==-1)
  		return null;
  	if($item!=null){
  		$item->commit = 1;
  		$item->save();
  		$test = Cartpreview::findOrFail($id);
  		if($test->commit==1)
  			return "success";
  		else
  			return "null";
  	}else{
  		return null;
  	}
  	return null;
  }

  public function rejectfile($id){
  	$item = Cartpreview::findOrFail($id);
  	//tidak bisa di lakukan bila sudah accepted ATAU rejected
  	if($item->commit==1 || 
  		$item->commit==-1)
  		return null;
  	if($item!=null){
  		$item->commit = -1;
  		$item->save();
  		$test = Cartpreview::findOrFail($id);
  		if($test->commit==-1)
  			return "success";
  		else
  			return "null";
  	}else{
  		return null;
  	}
  	return null;
  }


  public function undofile($id){
  	$item = Cartpreview::findOrFail($id);
  	//tidak bisa di lakukan bila sudah accepted ATAU rejected
  	if($item->commit==0)
  		return null;
  	if($item!=null){
  		$item->commit = 0;
  		$item->save();
  		$test = Cartpreview::findOrFail($id);
  		if($test->commit==0)
  			return "success";
  		else
  			return "null";
  	}else{
  		return null;
  	}
  	return null;
  }
}
