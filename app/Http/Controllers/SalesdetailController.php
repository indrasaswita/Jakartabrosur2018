<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesdetail;
use App\Customer;
use App\Salesheader;

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

      foreach ($salesdetail['cartheader']['cartfile'] as $i => $ii) {
        $salesdetail['cartheader']['cartfile'][$i]->makeVisible(['created_at']);
        $salesdetail['cartheader']['cartfile'][$i]['created_at'] = $salesdetail['cartheader']['cartfile'][$i]['created_at']->format('Y-m-d H:i:s');
      }

	  	return view('pages.order.sales.commit', compact('salesdetail'));
	  }else{
	  	return view('errors.forbidden');
	  }
  }

  function historySalesCustomer()
  {
    $customerID = session()->get('userid');
    $headers = Salesheader::orderBy("salesheaders.id", "desc")
       ->with('customer')
       ->with('salesdetail')
       ->where('customerID', $customerID)
       ->get();

    return view('pages.order.sales.customersaleshistory', compact('headers'));
  }
}
