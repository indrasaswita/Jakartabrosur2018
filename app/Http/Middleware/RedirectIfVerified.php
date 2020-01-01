<?php

namespace App\Http\Middleware;

use Closure;
use App\Customer;
use App\Logic\Utility\Helper;

class RedirectIfVerified
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
		$url_full = $request->getRequestUri();
		$position = Helper::indexOf($url_full, "public/");
		$url_trimmed = substr($url_full, $position+7);
		$url_start = substr($url_full, 0, $position+7);
//dd($url_start."login?url=".$url_trimmed);
		if (session()->has('role')){
			if (session()->get('role') == "customer"){

				$userid = session()->get('userid');

				if($userid==null)
					return redirect()->route('pages.account.login');
				else{

					$customer = Customer::find($userid);

					if($customer != null){
						if($customer['verified']==1){
							return $next($request);
						}else{
							return redirect()->route('pages.verification');
						}
					}else{
						return redirect()->route('pages.account.signup');
					}
				}
			}
		}
		return redirect()->to("login?url=".$url_trimmed);//->route('pages.account.login');
	}
}
