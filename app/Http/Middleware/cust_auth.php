<?php

namespace App\Http\Middleware;
use Illuminate\Routing\UrlGenerator;
use Closure;
use Session;
class cust_auth
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

        if(!Session::has('cust_logged_id')){
            $url = url()->current();
            return redirect('login?http_redirect='.$url);
        }

        return $next($request);
    }
}
