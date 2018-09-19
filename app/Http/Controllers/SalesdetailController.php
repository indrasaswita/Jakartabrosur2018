<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesdetail;

class SalesdetailController extends Controller
{
  public function showCommitByID($id, $sid, $tk){
  	$salesdetail = Salesdetail::where('id', $id)
				->where('salesID', $sid)
  			->whereIn('salesID', function($query) use($tk){
  				$query->from('salesheaders')
  					->select('id')
  					->whereIn('customerID', function($query2) use ($tk){
  							$query2->from('customers')
  								->select('id')
  								->where('remember_token', $tk)
  								->get();
  					})
  					->get();
  			})
  			//->where('commited', '0')
  			//commit / ga commit boleh soalnya nanti di bedain di view nya
  			->with('cartheader')
  			->first();

  	if($salesdetail!=null){
  		$salesdetail['cartheader']['cartfile']->makeVisible(['created_at']);

	  	return view('pages.order.sales.commit', compact('salesdetail'));
	  }else{
	  	return view('errors.forbidden');
	  }
  }
}
