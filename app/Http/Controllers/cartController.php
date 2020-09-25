<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;
class cartController extends Controller
{
    function add(Request $Request){
    	$Request->validate([
    		"pid" => "required"
    	]);

    	$pid = strip_tags($Request->pid);
    	$pid = str_replace('%', "", $pid);
    	$pid = str_replace('=', "", $pid);
    	$pid = str_replace('-', "", $pid);
    	$pid = str_replace('*', "", $pid);
    	$pid = str_replace('@', "", $pid);

    	$product_Details = Product::where('pid',$pid)->select('pid')->get()->toarray();

    	if(count($product_Details) > 0){
    		
    		$shopping_cart_items = [
    			$product_Details[0]['pid'] => [
    				"Quantity" =>	1
    			]
    		];



    		$SessionCart = (Session::has('shopping_cart'))? Session::get('shopping_cart') : array();

    		if(array_key_exists($product_Details[0]['pid'], $SessionCart)){
    			$quantity = ($Request->quantity > 0)? strip_tags($Request->quantity) : 1;

    			if($Request->quantityUpdated == true){

                    $SessionCart[$pid]['Quantity'] = ( $SessionCart[$pid]['Quantity'] + $quantity );
    				

    			}else {

                    $SessionCart[$pid]['Quantity'] = $SessionCart[$pid]['Quantity'] + 1;

    			}
    			Session::put('shopping_cart',$SessionCart);
    			return redirect('cart');

    		}else{

    			if(count($SessionCart) > 0){
    				foreach ($SessionCart as $key => $value) {
    					$shopping_cart_items[$key] = $value;
    				}
    			}

    			Session::put('shopping_cart',$shopping_cart_items);
    			Session::flash('msg',"An item added into your Cart");
    		
    			return redirect('cart');

    		}




    	}else{
    		Session::flash('msg',"We can't Found your selected product");
    		
    		return redirect('cart');
    	}

    }

    function remove(Request $Request){
    	$Request->validate([
    		"pid" => "required"
    	]);

    	$pid = strip_tags($Request->pid);
    	Session::forget("shopping_cart.".$pid);

    	Session::flash('msg',"An item Removed from your Cart");
    	return redirect('cart');

    }

    function decrement_quantity(Request $Request){
    	$Request->validate([
    		"pid" => "required"
    	]);

    	$pid = strip_tags($Request->pid);
    	$SessionCart = (Session::has('shopping_cart'))? Session::get('shopping_cart') : array();

    	if(array_key_exists($pid, $SessionCart)){
	    	if($Request->digit != "" && $Request->digit > 0){
	    		if($SessionCart[$pid]['Quantity'] > 1){
	    			$SessionCart[$pid]['Quantity'] = ( $SessionCart[$pid]['Quantity'] - $Request->digit );
	    		}
	    		
	    	}else{
	    		if($SessionCart[$pid]['Quantity'] > 1){
	    			$SessionCart[$pid]['Quantity'] = ( $SessionCart[$pid]['Quantity'] - 1 );
	    		}
	    	}
	    }
    	
	    Session::put('shopping_cart',$SessionCart);
    	return redirect('cart');
    }
}
