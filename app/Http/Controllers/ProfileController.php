<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests;

class ProfileController extends Controller
{
    public function index()
    {
        $customerID = session()->get('userid');
        $customer = Customer::join('companies', 'companies.id', '=', 'companyID')
                            ->where('customers.id', '=', $customerID)
                            ->select('companies.*', 'customers.*')
                            ->first();
                            //return $customer;
        return view('pages.account.profile', compact('customer'));
    }

    public function changepass()
    {
        $customerID = session()->get('userid');
        $customer = Customer::findOrFail($customerID);
        return view('pages.account.chpass', compact('customer'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
