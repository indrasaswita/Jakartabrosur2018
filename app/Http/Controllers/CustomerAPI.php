<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util;
use App\Customer;
use App\Company;
use App\City;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CustomerAPI extends Controller
{
	public function makesession($id){
    $item = Customer::findOrFail($id);
    if($item == null){
      return null;
    }else{
      $a = Carbon::parse($item['updated_at']);
      $b = Carbon::now();
      $diff = $a->diffInSeconds($b);
      $item->makeVisible(['remember_token']);

      if($diff > 600){ 
        // kalo uda 10 menit lebih session expired
        // jadi kalo uda lebih dari 10 menit di buat baru
        $item->remember_token = substr(str_replace('/', '', Hash::make(Carbon::now())), 20, 10);
        $item->save();
        return $item->remember_token;
      }else{
        //kalo belom 10 menit, tinggal show remmeber token
        return $item->remember_token;
      }
    }
  }

  public function getsession($id){
    $item = Customer::findOrFail($id);
    if($item == null){
      return null;
    }else{
      $a = Carbon::parse($item['updated_at']);
      $b = Carbon::now();
      $diff = $a->diffInSeconds($b);
      $item->makeVisible(['remember_token']);

      if($diff > 600){
        // kalo lebih dari 10 menit, return null
        return null;
      }else{
        return $item->remember_token;
      }
    }
  }

  public function apiGetName()
  {
    $customers = Customer::select('id', 'name', 'address')
        ->get();
    if(count($customers)==0)
      return null;
    return json_encode($customers);
  }

  public function apiGetSalesByCustID($id){

    $sales = Customer::with('salesheader')
        ->with('company')
        ->where('id', '=', $id)
        ->first();

    if($sales == null)
      return null;

    foreach ($sales['salesheader'] as $i => $salesheader) {
      $totalbayar = 0;
      $totalprintprice = 0;
      $totaldeliveryprice = 0;
      $totaldiscount = 0;
      $totalbuyprice = 0;
      foreach($salesheader['salesdetail'] as $j => $salesdetail){
        $totalprintprice += $salesdetail['cartheader']['printprice'];
        $totaldiscount += $salesdetail['cartheader']['discount'];
        $totaldeliveryprice += $salesdetail['cartheader']['deliveryprice'];
        $totalbuyprice += $salesdetail['cartheader']['buyprice'];
      }
      foreach($salesheader['salespayment'] as $k => $salespayment){
        //KALO UDA VERIF BARU DI ITUNG UDA BAYAR
        if($salespayment['salespaymentverif']!=null)
          $totalbayar += $salespayment['ammount'];
      }
    }

    if(count($sales['salesheader'])>0)
    {
      $result['totalpayment'] = $totalbayar;
      $result['totaltransaction'] = count($sales['salesheader']);
      $result['totaldiscount'] = $totaldiscount;
      $result['totalprintprice'] = $totalprintprice;
      $result['totaldeliveryprice'] = $totaldeliveryprice;

      $totalbelanja = $totalprintprice + $totaldeliveryprice - $totaldiscount;
      if($totalbayar > $totalbelanja)
        $result['totaldebt'] = 0;
      else
        $result['totaldebt'] = $totalbelanja - $totalbayar;
      $result['totalsales'] = $totalbelanja;

      return $result;
    }else{
      return null;
    }

  }
}
