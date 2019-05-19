<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cache;
use Closure;

class RedirectIfNotAdministator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $foo)
    {
        $response = $next($request);
        /*if (!$request->user()->isATeamAdministrator()){
            return redirect('roles');
        }*/
        //dd($response);
        return $response;
    }
}
