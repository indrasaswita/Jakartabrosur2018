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
}
