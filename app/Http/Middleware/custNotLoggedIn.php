<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class custNotLoggedIn
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
        if(Session::has('cust_logged_id')){
            return redirect('/account');
        }
        return $next($request);
    }
}
