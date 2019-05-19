<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Customer;
use App\Employee;
use App\Http\Requests;
use Cookie;
use Session;

class UserController extends Controller
{
	public function login(Request $request){
		$email = $request->email;
		$password = $request->password;
		$customer = Customer::where('email', '=', $email)->first();
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
				}
				else
				{
					//DIA CEK kalo uda berhasil verify, BRARTI langsung ke halaman HOME / redirect ke page yang ada di url 
					$msg = "LOG-IN berhasil!";
					$typ = "alert-success";
				}
			}
			else
			{
				$msg = "Password Anda salah";
				$typ = "alert-danger";
			}
		}else{
			$employee = Employee::join('roles', 'roles.id', '=', 'roleID')
								->where('email', '=', $email)
								->select('employees.*', 'roles.name as rolename')
								->first();
			if ($employee != null)
			{
				if(\Hash::check($password, $employee['password']))
				{
					Session::put('role', $employee['rolename']);
					session()->put('name', $employee['name']);
					session()->put('email', $employee['email']);
					session()->put('userid', $employee['id']);
					//return redirect()->route('pages.order.flyer');
					$msg="Logged-in as Employee";
					$typ = "alert-success";
				}
				else
				{
					$msg = "Password wrong";
					$typ = "alert-danger";
				}
			}
			else
			{
				$msg = "Belum terdaftar..";
				$typ = "alert-danger";
			}
		}
		session()->get('role');
		$result = array('message'=>$msg, 'type'=>$typ);
		return json_encode($result);
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
