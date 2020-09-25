<?php

namespace App\Http\Middleware;
use Illuminate\Routing\UrlGenerator;
use Closure;
use Session;
use DB;
class adminOnly
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

        if(Session::has('ap_logged_id')){
            
            $emp_role = DB::table('employees')->where('emp_id',Session::get('ap_logged_id'))->get()->toarray();

            $emp_role =  $emp_role[0]->role;
            
            if($emp_role != "Admin"){
                echo "You Can't Access This Page. Please Contact your admin";exit;
            }


        }
      
        return $next($request);
    }
}
