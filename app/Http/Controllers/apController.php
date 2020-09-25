<?php
/*

*   Admin panel controller


*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\payment;
use App\order;
use App\Customer;
use App\employee;
use DateTime;

class apController extends Controller
{


    // products page
        function viewProducts(){
            $products = Product::orderby('created_at','DESC')->paginate(10);
            return view("admin.products.all",['products' => $products]);
        }

    // categorie
        function viewCategories(){
            $categories = Category::orderby('created_at','DESC')->paginate(5);
            return view("admin.categories.all",['categories' => $categories]);
        }

    // orders

        function viewAllOrders(Request $Request){
            if($Request->search){
                $orders = order::where('status','Ordered')->where("ord_id",str_replace("=", "", strip_tags($Request->search)))->orwhere("cust_id" , str_replace("=", "", strip_tags($Request->search)))->orderby('created_at','DESC')->paginate(5000);
            }else{
                $orders = order::where('status','Ordered')->orderby('created_at','DESC')->paginate(5);
            }


            return view("admin.orders.all",['orders' => $orders]);
        }
        function viewCancelledOrders(){
            $orders = order::where('status','Cancelled')->orderby('created_at','DESC')->paginate(5);
            return view("admin.orders.cancelledOrders",['orders' => $orders]);
        }



    // payments

        function viewAllPayments(Request $Request){

            if($Request->search){
                $payments = payment::where("order_id",str_replace("=", "", strip_tags($Request->search)))->orwhere("cust_id" , str_replace("=", "", strip_tags($Request->search)))->orwhere("transaction_id" , str_replace("=", "", strip_tags($Request->search)))->orderby('created_at','DESC')->paginate(5000);
            }else{
                $payments = payment::orderby('created_at','DESC')->paginate(50);
            }

            return view("admin.payments.all",['payments' => $payments]);
        }


        function payment_msrefunded(Request $Request){
            $Request->validate([
                'txn_id' => "required",
            ]);

            payment::where("transaction_id",$Request->txn_id)->update([
                "status"    => "Refunded | ".date('jS M, Y (l)')
            ]);
            return redirect('admin/payments');
        }


    // customers

    function viewAllCustomers(Request $Request){

        if($Request->search){
            $customers = Customer::where("cust_id",str_replace("=", "", strip_tags($Request->search)))->orderby('created_at','DESC')->paginate(5000);
        }else{
            $customers = Customer::orderby('created_at','DESC')->paginate(50);

        }


        return view("admin.customers.all",['customers' => $customers]);
    }


    // employees


    function viewAllEmployees(Request $Request){

        if($Request->search){
            $employees = employee::where("emp_id",str_replace("=", "", strip_tags($Request->search)))->orderby('created_at','DESC')->paginate(5000);
        }else{

            if($Request->type){
                if($Request->type == "verified"){
                    $employees = employee::where('verified_document',"<>",'Not Verified')->orderby('created_at','DESC')->paginate(500);
                }else if($Request->type == "notverified"){
                    $employees = employee::where('verified_document','Not Verified')->orderby('created_at','DESC')->paginate(500);
                }else  if($Request->type == "blocked"){
                    $employees = employee::where('acc_status','0')->orderby('created_at','DESC')->paginate(500);
                }

            }else{
                $employees = employee::orderby('created_at','DESC')->paginate(50);
            }
            

        }


        return view("admin.employees.all",['employees' => $employees]);
    }

    

}
