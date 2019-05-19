<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Customer;
use App\Mail\VerifyMail;
use App\Http\Requests;
use App\Http\Requests\CustomerRequest;
use Hash;
use Mail;
use Carbon\Carbon;
use DB;

class CustomerController extends Controller
{
	
	public function index()
	{
		$customers = Customer::with('company', 'salesheader', 'customerbankacc')
				->orderBy('name', 'asc')
				->get(); 
		/*$role = Cache::get('role');
		$fullname = Cache::get('name');
		$email = Cache::get('email');*/
		$customers->makeVisible(['balance']);
		return view('pages.admin.master.customer.index', compact('customers'));
	}

	public function verifyEmail($token)
	{
		$verifyUser = Customer::where('verify_token', $token)
				->first();

		if($verifyUser!=null){
			$a = Carbon::now();
			$b = Carbon::parse($verifyUser['updated_at']);
			$diff = $b->diffInSeconds($a);
			if($diff >= 100)
			{
				return redirect('/login');	
			}
			else
			{
				DB::table('customers')->where('id', '=', $verifyUser['id'])
					->update(['verify_token' => null]);
				$status = "Email anda sudah diverifikasi";
			}
		}
		else{
			return view('pages.account.resendemail');	
		}
		 return redirect('/home');
	}

	public function verification()
	{
		if(session()->get('email')==null){
			return redirect()->route('pages.home');
		}else{

			$email = session()->get('email');

			$customer = null;
			if(session()->get('userid')!=null)
				$customer = Customer::findOrFail(session()->get('userid'));

			if($customer==null)
				return redirect()->route('pages.home');
			else if($customer['verify_token']==null)
				return redirect()->route('pages.home');
			else
				return view('pages.account.resendemail', compact('email'));	
		}
	}

	public function panggilemail()
	{
		return view('mails.verifymail');
	}
}
