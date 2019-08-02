<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Customer;
use App\Employee;
use App\Http\Requests;
use Cookie;
use Session;
use Carbon\Carbon;
use App\Logic\Curl\Onesignal;
use App\Employeeonesignal;
use App\Customeronesignal;

class UserController extends Controller
{
	public function login(Request $request){
		$email = $request->email;
		$password = $request->password;
		$customer = Customer::where('email', '=', $email)->first();
		$userid = "";
		$recipients = [];
		if ($customer != null){
			if(\Hash::check($password, $customer['password']))
			{

				session()->put('role', 'customer');
				session()->put('name', $customer['name']);
				session()->put('email', $customer['email']);
				session()->put('userid', $customer['id']);

				if($customer['verify_token'] != null)
				{
					//DIA BAKAL LGIN, TAPI KALO ADA TOKEN, dia redirect langsung ke verificationpage
					$msg = "";
					$typ = "verification";
					$userid = "VR".$customer['id'];
				}
				else
				{
					//DIA CEK kalo uda berhasil verify, BRARTI langsung ke halaman HOME / redirect ke page yang ada di url 
					$msg = "LOG-IN berhasil!";
					$typ = "alert-success";
					$userid = "CU".$customer['id'];
				}
			}
			else
			{
				$msg = "Password Anda salah";
				$typ = "alert-danger";
				$userid = "";
			}


			foreach ($customer['customeronesignal'] as $i => $ii) {

				array_push($recipients, $ii['onesignal']['player_id']);

				Customeronesignal::find($ii['id'])
					->increment('count');
			}

		}else{
			
			$employee = Employee::with('role')
								->with('employeeonesignal')
								->where('email', '=', $email)
								->first();
			if ($employee != null)
			{
				if(\Hash::check($password, $employee['password']))
				{
					Session::put('role', $employee['role']['name']);
					session()->put('name', $employee['name']);
					session()->put('email', $employee['email']);
					session()->put('userid', $employee['id']);
					//return redirect()->route('pages.order.flyer');
					$msg="Logged-in as Employee";
					$typ = "alert-success";
					$userid = "EM".$employee['id'];
				}
				else
				{
					$msg = "Password wrong";
					$typ = "alert-danger";
					$userid = "";
				}


				foreach ($employee['employeeonesignal'] as $i => $ii) {

					array_push($recipients, $ii['onesignal']['player_id']);

					Employeeonesignal::find($ii['id'])
						->increment('count');
				}
			}
			else
			{
				$msg = "Belum terdaftar..";
				$typ = "alert-danger";
				$userid = "";
			}
		}

		if(count($recipients)>0){
			$onesignal = new Onesignal();
			$ip = $request->ip();
			$text = "Status: ".$msg.". Someone login with your account. Is it you? ".($ip=="::1"?"Local Login":$this->startsWith($ip, '192.168')?"Remote Login":"From ".$ip)." @".Carbon::now().".";
			//dd($text);
			$response = $onesignal->sendMessage("Did you log-in to Web?", $text, $recipients);
		}

		session()->get('role');
		$result = array('message'=>$msg, 'type'=>$typ, 'userid'=>$userid);
		return json_encode($result);
	}

	function startsWith ($string, $startString) 
	{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
	} 

	public function logout(Request $request){
		$data = session('name');
		session()->flush();
		//return redirect()->back();
		return redirect()->route('pages.home');
		//return view('pages.goodbye', compact('data'));
	}

	public function loginpage(Request $request){
		$data = $request->all();
		if($data!=null)
			$url = $data['url'];
		else
			$url = '';
		//dd(session()->all());
		return view('pages.account.loginpage', compact('url'));
	}
	public function signuppage(){
		return view('pages.account.signuppage');
	}

	public function resendemail(){
		return view('includes.konfirmasiemail');
	}
}
