<?php

namespace App\Http\Middleware;

use Closure;

class InstalledMiddleware
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
    	if(\Configuration::installed()) {
    		return $next($request);
    	}
    	else {
    		if( !$request->is('install') ) {
    			return \Redirect::to('install');
    		}
    		else {
    			return $next($request);
    		}
    	}
    }
}
