<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customerbankacc;
use App\Http\Requests;
use Carbon\Carbon;

class CustomerbankaccController extends Controller
{
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$input = $request->all();
		$customerbankacc = Customerbankacc::findOrFail($id);
		$customerbankacc->update($input);
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$customerbankacc = Customerbankacc::findOrFail($id);
		$customerbankacc->delete();
		return redirect()->back();
	}

	public function apiStore(Request $request){
		//return $request;
		$customerID = session()->get('userid');
		$acc = new Customerbankacc();
		$acc->customerID = $customerID;
		$acc->bankID = $request['bankID'];
		$acc->accname = $request['accname'];
		$acc->accno = $request['accno'];
		$acc->acclocation = $request['acclocation'];
		$acc->save();

		return $this->apiGetAll();
	}

	
}
