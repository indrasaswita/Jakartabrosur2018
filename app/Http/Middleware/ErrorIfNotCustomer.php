<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cache;
use Closure;

class ErrorIfNotCustomer
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
		if (session()->has('role'))
			if (session()->get('role') == "customer")
				return $next($request);
		return response("Customer Restriction", 403);
	}
}
