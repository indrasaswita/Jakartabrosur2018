<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Employee;
use App\Customer;
use App\Onesignal;


class HomeController extends Controller
{

	public function index()
	{
		if(session()->has('role')){
			//LOGINED
			if(session()->get('role') == 'Administrator'){

				$customers = Customer::all();

				return view('pages.home', compact('customers'));
			}else{

				return view('pages.home');
			}
		}
		else{
			//KALO BELOM LOGIN
			return view('pages.home');
		}
	}

	public function sendmail(){
		$title="TEST BRADERS";
		$message="Dear aliuntung";
		Mail::send('index', ['title' => $title, 'message' => $message], function ($message)
		{
			//$message->from('indrasaswita@gmail.com', 'Jakarta Brosur No-reply');
			$message->to('rahayu_printing@yahoo.co.id')
					->subject('Cart Placed Reminder');
		});
	}
	

}
