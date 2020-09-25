<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\tracking_service;
use App\ordered_product;
use App\payment;
use Session;
use dateTime;

class ordersController extends Controller
{
    function cancelOrder(Request $Request){
    	$Request->validate([
    		'oid' => "required",
    	]);

        $shipmentDetails = tracking_service::where('order_id',str_replace('=', "", strip_tags($Request->oid)))->get()->toarray();
        echo '<link rel="stylesheet" href="'.asset('css/bootstrap.min.css').'"> <link rel="stylesheet" href="'.asset('css/style.css').'">';

        if(count($shipmentDetails) > 0){
            if ($shipmentDetails[0]['under_processed'] == null && $shipmentDetails[0]['dispatched'] == null && $shipmentDetails[0]['delivered'] == null) {
                order::where([
                    "ord_id"	=>	str_replace('=', "", strip_tags($Request->oid)),
                    "cust_id"	=> Session::get('cust_logged_id'),

                ])->update([
                    "status"	=> "Cancelled",
                ]);

                tracking_service::where([
                    "order_id"	=>	str_replace('=', "", strip_tags($Request->oid)),
                ])->delete();

                ordered_product::where([
                    "oid"	=>	str_replace('=', "", strip_tags($Request->oid)),
                ])->delete();

                payment::where([
                    "order_id" => str_replace('=', "", strip_tags($Request->oid)),
                ])->update([
                    "status"    => "Refund Requested"
                ]);

                return redirect('orders');
            } else {
                echo "<div class='card m-5 p-3 text-center'>
                <center> <img src='".asset('img/support/sad.jpg')."'  class='img-fluid' style='width:150px' alt=></center>
                    <h1 style='color:red;''>Order Not Found</h1><p>We Can't find any of your order to cancel.</p>
                    <br>
                    <p>We Can't able to Cancel your order. If need please contact our support team.</p>
                </div>";
            }
        }else{
            echo "<div class='card m-5 p-3 text-center'>
           <center> <img src='".asset('img/support/sad.jpg')."'  class='img-fluid' style='width:150px' alt=></center>
                <h1 style='color:red;''>Order Not Found</h1><p>We Can't find any of your order to cancel.</p>
                <br>
                <p>We Can't able to Cancel your order. If need please contact our support team.</p>
            </div>";
        }



    }


    function acceptOrder(Request $Request){
        $Request->validate([
    		'oid' => "required",
        ]);

        $totalOrders = order::get();
        $totalOrders = count( $totalOrders);

        order::where([
            "ord_id"	=>	str_replace('=', "", strip_tags($Request->oid)),
        ])->update([
            "invoice_number"	=> crc32(date("dmyhis").$totalOrders.mt_rand(1577,6587)),
        ]);

        tracking_service::where([
            "order_id"	=>	str_replace('=', "", strip_tags($Request->oid)),
        ])->update([
            "under_processed" => date('Y-m-d h:i:s')
        ]);

        return redirect('admin/orders/open?oid='.$Request->oid);
    }

    function rejectOrder(Request $Request){
    	$Request->validate([
    		'oid' => "required",
    	]);



        order::where([
            "ord_id"	=>	str_replace('=', "", strip_tags($Request->oid)),


        ])->update([
            "status"	=> "Cancelled",
        ]);

        tracking_service::where([
            "order_id"	=>	str_replace('=', "", strip_tags($Request->oid)),
        ])->delete();

        ordered_product::where([
            "oid"	=>	str_replace('=', "", strip_tags($Request->oid)),
        ])->delete();

        payment::where([
            "order_id" => str_replace('=', "", strip_tags($Request->oid)),
        ])->update([
            "status"    => "Refund Requested"
        ]);




        return redirect('admin/orders');



    }

    function shipOrder(Request $Request){
        $Request->validate([
    		'oid' => "required",
        ]);




        tracking_service::where([
            "order_id"	=>	str_replace('=', "", strip_tags($Request->oid)),
        ])->update([
            "dispatched" => date('Y-m-d h:i:s')
        ]);

        return redirect('admin/orders/open?oid='.$Request->oid);
    }






    function deliveredOrder(Request $Request){
        $Request->validate([
            'oid' => "required",
        ]);

        tracking_service::where([
            "order_id"	=>	str_replace('=', "", strip_tags($Request->oid)),
        ])->update([
            "delivered" => date('Y-m-d h:i:s')
        ]);

        return redirect('admin/orders/open?oid='.$Request->oid);

    }


}
