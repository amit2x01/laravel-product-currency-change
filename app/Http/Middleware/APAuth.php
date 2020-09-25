<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class APAuth
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
        if(!Session::has('ap_logged_id')){
            $url = url()->current();
            return redirect('/admin/login?http_redirect='.$url);
        }
        return $next($request);
    }
}
