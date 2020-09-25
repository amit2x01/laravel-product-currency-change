<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\CustAddress;
use Session;

class custController extends Controller
{
    function view_account(){
    	$customerDetails = Customer::where(['cust_id' => Session::get('cust_logged_id')])->get()->toarray();
    	return view('customer.account',['customerDetails'=>$customerDetails[0]]);
    }

    function view_address(){
        $CustAddress = CustAddress::where(['cust_id' => Session::get('cust_logged_id')])->get()->toarray();
        return view('customer.address',['CustAddress'=>$CustAddress]);
    }





    function view_modify(){
    	$customerDetails = Customer::where(['cust_id' => Session::get('cust_logged_id')])->get()->toarray();
    	return view('customer.modify_pages.upd_account',['customerDetails'=>$customerDetails[0]]);
    }


    function modify(Request $Request){
    	$custId = Session::get('cust_logged_id');
    	$Request->validate([
    		"modify_email"		=>	"required | email | unique:customers,cust_email,$custId,cust_id",
    		"modify_phone"		=>	"required | min:10 | max:10 | unique:customers,cust_phone,$custId,cust_id",
    		"modify_name"		=>	"required | min:3",

    	],[],[
    		"modify_email"		=>	"Email Address",
    		"modify_phone"		=>	"Phone Number",
    		"modify_name"		=>	"Full Name"
    	]);

    	$dob = (isset($Request->modify_dob)) ? strip_tags($Request->modify_dob) : NULL;

    	 Customer::where(['cust_id' => Session::get('cust_logged_id')])->update([

    	 	"cust_name"			=>		strip_tags($Request->modify_name),
    	 	"cust_email"		=>		strip_tags($Request->modify_email),	
    	 	"cust_phone"		=>		strip_tags($Request->modify_phone),	
    	 	"cust_gender"		=>		strip_tags($Request->modify_gender),	
    	 	"cust_dob"			=>		$dob,

    	 ]);

    	 Session::flash('update_msg',"Update Successful");
    	 return redirect('account/modify');

    }

    function modify_address(){
        $CustAddress = CustAddress::where(['cust_id' => Session::get('cust_logged_id')])->get()->toarray();
        return view('customer.modify_pages.upd_address',['CustAddress'=>$CustAddress]);
    }

    function modify_address_submit(Request $Request){
        $custId = Session::get('cust_logged_id');
        $Request->validate([
            "hno"      =>  "required | max:100",
            "address"      =>  "required | min:5 | max:200",
            

            "city"      =>  "required | max:100",
            "state"      =>  "required | max:100",
            "pincode"       =>  "required | max:100",
            "country"       =>  "required | max:100",

        ]);



        $landmark = ($Request->landmark)? strip_tags($Request->landmark)  : NULL;

         $CustAddress = CustAddress::where(['cust_id' => Session::get('cust_logged_id')])->get()->toarray();

         if(count($CustAddress) > 0){

            CustAddress::where(['cust_id' => Session::get('cust_logged_id')])->update([
                    
                    "address_type"      =>      strip_tags($Request->add_type),
                    "house_no"          =>      strip_tags($Request->hno),
                    "address"           =>      strip_tags($Request->address),
                    "landmark"          =>      strip_tags($landmark),
                    "city"              =>      strip_tags($Request->city),
                    "state"             =>      strip_tags($Request->state),
                    "country"           =>      strip_tags($Request->country),
                    "pincode"           =>      strip_tags($Request->pincode),


            ]);

         }else{
            CustAddress::insert([
                    "cust_id"           =>      strip_tags($custId),
                    "address_type"      =>      strip_tags($Request->add_type),
                    "house_no"          =>      strip_tags($Request->hno),
                    "address"           =>      strip_tags($Request->address),
                    "landmark"          =>      strip_tags($landmark),
                    "city"              =>      strip_tags($Request->city),
                    "state"             =>      strip_tags($Request->state),
                    "country"           =>      strip_tags($Request->country),
                    "pincode"           =>      strip_tags($Request->pincode),


            ]);
         }

         return redirect('/account/address');

    }




    function modify_password(Request $Request){
        $Request->validate([
            "password" => "required",
            "repassword" => "required | same:password",
        ],[

            "repassword.same" => "Both Passwords does not match.",
            "repassword.required" => "Please Re-Type Your Password.",
        ]);


        Customer::where(['cust_id' => Session::get('cust_logged_id')])->update(['cust_password' => sha1(md5(crc32($Request->password)))]);
        return redirect('/account');

    }





    // admin program


    function blockCustomer(Request $Request){
        $Request->validate([
            "cid" => "required",    
        ]);

        Customer::where('cust_id',$Request->cid)->update([
            'acc_status' => "0"
        ]);

        return redirect('/admin/customers?search='.$Request->cid);
    }

    function unBlockCustomer(Request $Request){
        $Request->validate([
            "cid" => "required",    
        ]);

        Customer::where('cust_id',$Request->cid)->update([
            'acc_status' => "1"
        ]);

        return redirect('/admin/customers?search='.$Request->cid);
    }

    function deleteCustomer(Request $Request){
        $Request->validate([
            "cid" => "required",    
        ]);

        Customer::where('cust_id',$Request->cid)->delete();

        return redirect('/admin/customers');
    }

    
}
