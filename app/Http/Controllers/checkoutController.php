<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\payment;
use App\tracking_service;
use App\order;
use App\ordered_product;
use App\CustAddress;
use DB;




class checkoutController extends Controller
{
    function payment_method(Request $Request){
    	$Request->validate([
    		"hno"					=>		"required",
    		"address"				=>		"required | min:3",
    		"pin"					=>		"required",
    		"city"					=>		"required",
    		"state"					=>		"required",
    		"country"				=>		"required",


        ]);

            $cust_pre_address = CustAddress::where('cust_id',Session::get('cust_logged_id'))->get();

        if(count($cust_pre_address) > 0):

            CustAddress::where('cust_id',Session::get('cust_logged_id'))->update([

            "house_no"          =>  $Request->hno,
            "address"           =>  $Request->address,
            "city"              =>  $Request->city,
            "state"             =>  $Request->state,
            "country"           =>  $Request->country,
            "pincode"           =>  $Request->pin,

            ]);

        else:

            CustAddress::insert([
                "cust_id"           =>  Session::get('cust_logged_id'),
                "house_no"          =>  $Request->hno,
                "address"           =>  $Request->address,
                "city"              =>  $Request->city,
                "state"             =>  $Request->state,
                "country"           =>  $Request->country,
                "pincode"           =>  $Request->pin,

                ]);

        endif;




    	$delivery_time_slot = ($Request->delivery_time_slot == 1 || $Request->delivery_time_slot == 2)?$Request->delivery_time_slot:1;

    	$address = strip_tags($Request->hno).", ".strip_tags($Request->address).", ".strip_tags($Request->city)." - ".strip_tags($Request->pin).", State : ".strip_tags($Request->state).", Country : ".strip_tags($Request->country);


    	return view('customer.checkout.payment_method',['address'=>$address]);

    }


    function order_review(Request $Request){
    	$Request->validate([
    		"address"		=>	"required",
    		"pay_mode"		=>	"required"

    	]);

    	return view('customer.checkout.review',['address'=>$Request->address,'pay_mode'=>$Request->pay_mode]);
    }


    function payorder(Request $Request){
    	echo '<link rel="stylesheet" href="'.asset('css/bootstrap.min.css').'"> <link rel="stylesheet" href="'.asset('css/style.css').'">';

    	if($Request->cnum == "" || strlen($Request->cnum) != 16 || $Request->cexp == "" || $Request->cvv == ""  || strlen($Request->cvv) != 3  || $Request->cholder == ""){
    		echo "<div class='card m-5 p-3'>
    		<img src='".asset('img/support/sad.jpg')."'  class='img-fluid' style='width:150px' alt=>
				<h1 style='color:red;''>Payment Failed</h1><p>Please Check your Card Number,Card Exp. or CVV Code</p>
				<br>
				<p>We Can't able to place your order. Press back button for modify details or re-order & re-payment</p>
    		</div>";
    	}else{


    		$subtotal = 0;

	    	foreach(Session::get('shopping_cart') as $product_id => $cart_quantity){

	              $productDetails = DB::table('products')->where('pid',$product_id)->get()->toarray();
	              if(!count($productDetails) > 0):
	              Session::forget("shopping_cart.".$product_id);
	              else:
	              $productDetails = $productDetails[0];


	              $subtotal += $cart_quantity['Quantity'] * $productDetails->price;


	              endif;
	         };


    		$this->place_order($Request->address,"PREPAID",[$Request->cnum,$Request->cexp,$Request->cholder],$subtotal);
    		Session::forget('shopping_cart');

    		return redirect('orders');

    	}


    }


    public function placeorder_pod(Request $Request){
        $subtotal = 0;

            foreach(Session::get('shopping_cart') as $product_id => $cart_quantity){

                  $productDetails = DB::table('products')->where('pid',$product_id)->get()->toarray();
                  if(!count($productDetails) > 0):
                  Session::forget("shopping_cart.".$product_id);
                  else:
                  $productDetails = $productDetails[0];


                  $subtotal += $cart_quantity['Quantity'] * $productDetails->price;


                  endif;
             };


            $this->place_order($Request->address,"Pay On Delivery",[],$subtotal);
            Session::forget('shopping_cart');

            return redirect('orders');
    }

    private function place_order($address,$pay_mode,$card_details = array(),$amount = ""){


    	$order_id = "403".mt_rand(14523675478,94523675478);
    	$subtotal = 0;

    	$products_listed = [];

    	foreach(Session::get('shopping_cart') as $product_id => $cart_quantity){

	              $productDetails = DB::table('products')->where('pid',$product_id)->get()->toarray();
	              if(!count($productDetails) > 0):
	              Session::forget("shopping_cart.".$product_id);
	              else:
	              $productDetails = $productDetails[0];

	              $products_listed[] = [

	              		"oid" 	=> $order_id,
	              		"pid"		=> $productDetails->pid,
	              		"ptitle"	=> $productDetails->ptitle,
	              		"pbrand"	=> $productDetails->brand,
	              		"pmodel"	=>	$productDetails->model,
	              		"qty"		=> $cart_quantity['Quantity'],
	              		"price"		=> $productDetails->price,

	              ];



	              $subtotal += $cart_quantity['Quantity'] * $productDetails->price;


              endif;
         };

    	if($pay_mode == "PREPAID"){

    		$card_number = $card_details[0];
    		$card_exp = $card_details[1];
    		$amount = ($amount) ?$amount:$subtotal;

    		$txn = "ONTS".mt_rand(45847254,95877254);
    		$ref = sha1(sha1(mt_rand(14587,52547)).sha1(mt_rand(14587,52547)).date('YDMMDY'));

    		$payment_by = "Debit Card";

    		payment::insert([
    			"transaction_id"		=>		$txn,
                "order_id"              =>      $order_id,
                "cust_id"               =>      Session::get('cust_logged_id'),
    			"txn_ref_no"			=>		$ref,
    			"payment_made_by"		=>		$payment_by,
    			"card_number"			=>		$card_number,
    			"card_exp_date"			=>		$card_exp,
    			"amount"				=>		$amount,
    		]);

    	}


    	order::insert([
            "ord_id"               =>      $order_id,
    		"cust_id"				=>		Session::get('cust_logged_id'),
    		"amount"				=>		 $subtotal,
    		"payment_mode"			=>		$pay_mode,


    		"delivery_address"		=>		$address,
    	]);



    	tracking_service::insert([
    		"order_id"			=>		$order_id,
    		"exp_delivery_date"			=>		date('Y-m-d', strtotime("+3 day")),
    	]);

    	ordered_product::insert($products_listed);

    	Session::forget('shopping_cart');
    }
}
