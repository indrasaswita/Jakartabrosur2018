<?php

namespace App\Logic\Stat;

use App\Salesheader;


class AllSalesFilter{

	public static function semua($customerID){
		$data = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->orderBy('id', 'desc')
				->get(); 
		return $data;
	}

	public static function belumbayar($customerID){
		$data = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereNotIn('id', function($query){
						$query->select('salesID')->from('salespayments');
				})
				->orderBy('id', 'desc')
				->get(); 
		return $data;
	}

	public static function diproses($customerID){
		$data = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereIn('id', function($query){
						$query->select('salesID')->from('salespayments')
						->join('salespaymentverifs', 'salespayments.id', '=', 'salespaymentverifs.paymentID');
				})
				->whereIn('id', function($query){
						$query->select('salesID')->from('salesdetails')
						->where('statusdone', '<>', '1');
				})
				->orderBy('id', 'desc')
				->get();
		return $data;
	}

	public static function dikirim($customerID){
		$data = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereIn('id', function($query){
					$query->select('salesID')->from('salesdetails')
					->where('statusdone', '=', '1');
				})
				->orderBy('id', 'desc')
				->get();
		return $data;
	}

	public static function selesai($customerID){
		$data = Salesheader::where('customerID', '=', $customerID)
				->with('customer')
				->with('salesdetail')
				->with('salesdelivery')
				->with('salespayment')
				->whereIn('id', function($query){
						$query->select('salesID')->from('salesdetails')
								->where('statusdelivery', '=', '1')
								->where('statusdone', '=', '0');
				})
				->orderBy('id', 'desc')
				->get();
		return $data;
	}
}


?>