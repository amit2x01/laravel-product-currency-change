<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\employee;

use Session;

class loginController extends Controller
{
    function cust_login(Request $Request){
    	$Request->validate([
    		"email"		=>	"required | email | min:3 | max:120",
    		"password"		=>	"required | min:3 | max:120",
    	],[
			"email.email"	=> "Invalid email address.",
    	]);

    	$email = $Request->email;
    	$password = $Request->password;

    	$password = sha1(md5(crc32($password)));

    	$loginDetails = Customer::where([
    		"cust_email"	=> $email,
    		"cust_password" => $password
    	])->get()->toarray();

    	if(count($loginDetails) > 0){

            if($loginDetails[0]['acc_status'] == "1"){
                Session::put('cust_logged_id',$loginDetails[0]['cust_id']);

                if($Request->_redirect_url != ""){
                    return redirect($Request->_redirect_url);
                }else{
                    return redirect('/');
                }
            }else{
                Session::flash('log_err',"Your Account is Blocked. Please Contact our Helpline Number for Unblock your Account.");
                if($Request->_redirect_url != ""){
                    return redirect('login?http_redirect='.$Request->_redirect_url);
                }else{
                    return redirect('login');
                }
            }

    		

    	}else{
    		Session::flash('log_err',"Invalid Username or Password.");
    		if($Request->_redirect_url != ""){
    			return redirect('login?http_redirect='.$Request->_redirect_url);
    		}else{
    			return redirect('login');
    		}
    	}
    }
    function ap_login(Request $Request){
    	$Request->validate([
    		"email"		=>	"required | email | min:3 | max:120",
    		"password"		=>	"required | min:3 | max:120",
    	],[
			"email.email"	=> "Invalid email address.",
    	]);

    	$email = $Request->email;
    	$password = $Request->password;

    	$password = sha1(md5(crc32($password)));

    	$loginDetails = employee::where([
    		"emp_email"	=> $email,
    		"emp_pass" => $password
    	])->get()->toarray();

    	if(count($loginDetails) > 0){

            if($loginDetails[0]['acc_status'] == "1"){
                Session::put('ap_logged_id',$loginDetails[0]['emp_id']);

                if($Request->_redirect_url != ""){
                    return redirect($Request->_redirect_url);
                }else{
                    return redirect('/admin');
                }
            }else{
                Session::flash('log_err',"Your Account is Blocked. Please Contact our Helpline Number for Unblock your Account.");
                if($Request->_redirect_url != ""){
                    return redirect('/admin/login?http_redirect='.$Request->_redirect_url);
                }else{
                    return redirect('/admin/login');
                }
            }

    		

    	}else{
    		Session::flash('log_err',"Invalid Username or Password.");
    		if($Request->_redirect_url != ""){
    			return redirect('/admin/login?http_redirect='.$Request->_redirect_url);
    		}else{
    			return redirect('/admin/login');
    		}
    	}
    }
    
}
