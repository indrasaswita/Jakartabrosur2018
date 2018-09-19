<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Cartdetail;
use App\Cartfile;
use App\Util;
use DB;
use App\Http\Requests\CartdetailstitleRequest;
use App\Http\Requests;
use App\Files;

class CartdetailController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{ // uda ga kepake delete aja
		$cartdetails = $this->apiGetAll();

		return view('pages.admin.cartdetails.index', compact('cartdetails'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$input = $request->all();
		Cartdetail::create($input);
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

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
		$cartdetail = Cartdetail::findOrFail($id);
		$cartdetail->update($input);
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
		$cartdetail = Cartdetail::findOrFail($id);
		$cartdetail->delete();
		return redirect()->back();
	}

	public function apiGetAll(){ //DEPRECATED
		$cartdetails = Cartdetail::join('customers', 'customers.id', '=', 'customerID')
				->join('papers', 'papers.id', '=', 'paperID')
				->join('cities', 'cities.id', '=', 'customers.cityID')
				->orderBy('cartdetails.id', 'desc')
				->select('customers.*', 'customers.name as customername', 'cities.name as cityname', 'customers.type as customertype', 'papers.name as papername', 'papers.gramature', 'cartdetails.*')
				->get();
		foreach ($cartdetails as $i => $item) {
			$item['files'] = Cartfile::join('files', 'files.id', '=', 'fileID')
				->where('cartdetailID', '=', $item['id'])
				->get();
		}

		return $cartdetails;
	}

	public function apiGetSpecificBySalesID($id){
		$cartdetails = Cartdetail::join('salesdetails', 'salesdetails.cartdetailID', '=', 'cartdetails.id')
									->join('salesheaders', 'salesheaders.id', '=', 'salesdetails.salesID')
									->join('papers', 'papers.id', '=', 'paperID')
									->where('salesheaders.id', '=', $id)
									->select('cartdetails.*', 'papers.*')
									->orderBy('cartdetails.id', 'asc')
									->get();
		return $cartdetails;
	}

	public function apiGetSpecificByCartID($id){
		$cartdetails = Cartdetail::join('papers', 'papers.id', '=', 'paperID')
									->where('cartdetails.id', '=', $id)
									->select('papers.*', 'cartdetails.*')
									->get();
		return $cartdetails;
	}

	public function apiUpdateTitle(CartdetailstitleRequest $request){
		$input = $request->all();
		if($input != null)
		{
			$cart = Cartdetail::find($input['cartID']);
			if($cart == null)
			{
				return "Data Keranjang tidak diketemukan. -ERROR-";
			}
			$cart->jobtitle = $input['jobtitle'];
			$cart->jobtype = $input['jobtype'];
			$cart->customernote = $input['customernote'];
			$cart->save();

			return $this->apiGetSpecificByCartID($input['cartID']);
		}
		return "Error, no data";
	}

	public function downloadByFileID($id){
		/*
		$file = Cartfile::join('files', 'files.id', '=', 'fileID')
						->join('cartdetails', 'cartdetails.id', '=', 'cartdetailID')
						->join('customers', 'customers.id', '=', 'cartdetails.customerID')
						->where('fileID', '=', $id)
						->select('customers.name as customername', 'cartdetails.*', 'cartfiles.*', 'files.*')
						->first(); //-> $id = fileID

					*/


		$file = Files::where('id', '=', $id)
						->with('customer')
						->with('cartfile')
						->first();

		if($file == null)
			return ["status"=>"error", 'data'=>"Wrong ID inputed"];
		else
		{
			//return "download";
			$filepath = public_path().'/'.$file['path'];
			if(file_exists($filepath))
				return response()->download($filepath, 'C'.sprintf("%04d", $file['cartfile']['cartheader']['id']).'-'.'F'.sprintf("%04d", $file['id']).'-'.substr($file['customer']['name'], 0, strpos($file['customer']['name'], ' ')).'-'.$file['cartfile']['cartheader']['jobtitle'].'('.$file['cartfile']['cartheader']['jobsubtype']['name'].')-R'.$file['revision'].substr($file['path'], strpos($file['path'], '.')));
			else
				return ["status"=>"error", 'data'=>"FILE NOT EXISTS"];
		}
	}
}
