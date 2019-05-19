<?php

namespace App\Http\Middleware;

use Closure;

class ErrorIfNotEmployee
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
			if (session()->get('role') == "Administrator")
				return $next($request);
		return response("Employee Restriction", 403);
	}
}
