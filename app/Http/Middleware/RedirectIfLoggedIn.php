<?php

namespace App\Http\Middleware;

use Closure;
use App\Customer;

class RedirectIfLoggedIn
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (session()->has('role')){
			if(session()->get('role')=="customer"){
				//CUSTOMER
				$email = session()->get('email');

				if($email==null)
					return redirect()->route('pages.account.login');
				else{

					$customer = Customer::where('email', $email)
							->first();

					if($customer != null){
						/*  SEMENTARA
						if($customer['verify_token']==null){
							return $next($request);
						}else{
							return redirect()->route('pages.verification');
						}*/
						return $next($request);
					}else{
						return redirect()->route('pages.account.signup');
					}
				}
			} else {
				//EMPLOYEE
				return $next($request);
			}
		}
		return redirect()->route('pages.account.login');
	}
}
