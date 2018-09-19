<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CustomerBankAcc;

class CustomerBankAccAPI extends Controller
{
    public function getByID($id)
    {
    	//$id = customerID
    	$acc = CustomerBankAcc::join('banks', 'banks.id', '=', 'bankID')
	    		->where('customerID', '=', $id)
	    		->orderBy('bankID', 'ASC')
	    		->select('customerbankaccs.id', 'accno', 'accname', 'alias', 'bankname')
	    		->get();
    	return $acc;
    }

    public function getAll(){
        $customerID = session()->get('userid');
        $accs = Customerbankacc::join('banks', 'bankID', '=', 'banks.id')
                ->where('customerID', '=', $customerID)
                ->select('banks.*', 'customerbankaccs.*')
                ->get();
        return $accs;
    }
}
