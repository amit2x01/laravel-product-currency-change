<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class signupController extends Controller
{
    function cust_signup(Request $Request){
    
    		$Request->validate([
    			"name"		=> "required | min:3 | max:120",
	    		"email"		=>	"required | email | min:3 | max:120 | unique:customers,cust_email",
	    		"phone"		=> "required | min:10 | max:10 | unique:customers,cust_phone",
	    		"password"		=>	"required | min:3 | max:120",
	    	],[
				"email.email"	=> "Invalid email address.",
	    	]);


	    	Customer::insert([
	    		"cust_name"			=> str_replace("=", "", strip_tags($Request->name)),
	    		"cust_email"		=> str_replace("=", "", strip_tags($Request->email)),
	    		"cust_phone"		=> str_replace("=", "", strip_tags($Request->phone)),
	    		"cust_password"		=> sha1(md5(crc32($Request->password))),
	    	]);


	    	if($Request->_redirect_url != ""){
    			return redirect("login?http_redirect=".$Request->_redirect_url);
    		}else{
    			return redirect('login');
    		}
    	
    }
}
