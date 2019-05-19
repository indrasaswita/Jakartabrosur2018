<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesheader;
use App\Salesdetail;
use App\Http\Requests;
use App\Salespayment;
use App\Salespaymentverif;
use DB;
use Carbon\Carbon;

class AllSalesCustomerView extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customerID = session()->get('userid');
        //BUAT AMBIL DATA (SALESDELIVERY) YANG TERAKHIR (MAX ID) DARI "GROUP SALESHEADER"
        $allsales = Salesheader::where('customerID', '=', $customerID)
                ->with('customer')
                ->with('salesdetail')
                ->with('salesdelivery')
                ->with('salespayment')
                ->orderBy('id', 'desc')
                ->get();

        $current = Carbon::now();

        foreach ($allsales as $i => $header) {
            if($header['salesdetail']!=null)
            {
                $header['salesdetail']->each(function($jj, $j){
                    $jj->makeVisible(['updated_at']);
                });

                foreach ($header['salesdetail'] as $j => $detail) {
                    $header['salesdetail'][$j]['pip'] = Carbon::parse($detail['updated_at'])->diffForHumans($current);
                }
            }
        }       
                
        return view('pages.order.sales.index', compact('allsales'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
