<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesdetail;
use App\Customer;
use App\Salesheader;

class SalesdetailController extends Controller
{

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
