<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// pages Control

Route::get('/', function () { return view('customer.homepage'); });
Route::get('/change/curr', 'Currency@changeCurrency');

Route::get('/products',"productsController@show_all_products");
Route::get('/products/filter/bycar',"productsController@show_products_by_car");
Route::get('/products/filter/Category',"productsController@show_products_by_Category");
Route::get('/products/search',"productsController@show_products_by_search");
Route::get('/products/open',function(){ return view('customer.singleProduct'); });

Route::get('/products/js/quickView','productsController@get_product_in_quick_view');

// homepage javascript search brands using select box
Route::get('/get/brands/select/options','productsController@get_model_numbers_by_group_print_select');


// Cart Control

Route::get('/cart', function () { return view('customer.cart'); });
Route::get('/cart/add', 'cartController@add');
Route::get('/cart/remove', 'cartController@remove');
Route::get('/cart/decrement', 'cartController@decrement_quantity');



// Login and registration Control
Route::group(["middleware" => ['custNotLoggedIn']],function(){

	Route::get('/login', function () { return view('customer.login'); });
	Route::post('/login','loginController@cust_login');


	Route::get('/signup',function(){ return view('customer.signup'); });
	Route::post('/signup','signupController@cust_signup');

});




Route::group(["middleware" => ['cust_auth']],function(){

	Route::get('/account', 'custController@view_account');
	Route::get('/account/address', 'custController@view_address');

	Route::get('/account/modify', 'custController@view_modify');
	Route::post('/account/modify', 'custController@modify');

	Route::get('/account/address/modify', 'custController@modify_address');
	Route::post('/account/address/modify', 'custController@modify_address_submit');

	Route::get('/account/modify/password', function(){ return view('customer.modify_pages.upd_password'); });
	Route::post('/account/modify/password', 'custController@modify_password');


	Route::get('/account/payments_history',function(){ return view('customer.payments_history'); });


	Route::get('/account/logout',function(){
		Session::forget('cust_logged_id');
		return redirect('login');
	});

	Route::group(["middleware" => ['cartAuth','cust_auth']],function(){

		Route::get('/checkout/billing', function(){ return view('customer.checkout.billing'); });
		Route::post('/checkout/payment_method', 'checkoutController@payment_method');

		Route::post('/checkout/order_review', 'checkoutController@order_review');

		Route::post('/checkout/payorder', 'checkoutController@payorder');		// for online payment
		Route::post('/checkout/placeorder', 'checkoutController@placeorder_pod');		// for pay on delivery


		Route::get('/checkout/payment_method',function(){
			return redirect('/checkout/billing');
		});
		Route::get('/checkout/order_review',function(){
			return redirect('/checkout/billing');
		});
		Route::get('/checkout/payorder',function(){
			return redirect('/checkout/billing');
		});
		Route::get('/checkout/placeorder',function(){
			return redirect('/checkout/billing');
		});


	});



	Route::get('/orders', function () { return view('customer.orders.myorders'); });
	Route::get('/orders/view', function () { return view('customer.orders.orderDetails'); });
	Route::get('/orders/cancel', 'ordersController@cancelOrder');



});









Route::view('/admin/login', "admin.login");
Route::post('/admin/login', "loginController@ap_login");
Route::get('/admin/logout', function(){
    Session::forget('ap_logged_id');
	return redirect('/admin/login');
});


Route::group(['middleware' => ['APAuth']],function(){


        // for staff/admin
        Route::get('/admin', function(){ return view('admin.dashboard'); });


        // products
        Route::get('/admin/products', "apController@viewProducts");
        Route::view('/admin/products/add', "admin.products.add");
        Route::post('/admin/products/add', "productsController@saveProduct");

        Route::view('/admin/products/modify','admin.products.update');
        Route::post('/admin/products/modify', "productsController@modifyProduct");
        Route::post('/admin/products/modify/image', "productsController@modifyProductImage");

        Route::get('/admin/products/delete', "productsController@deleteProduct");


        // categorie

        Route::get('/admin/categories', "apController@viewCategories");
        Route::view('/admin/categories/add', "admin.categories.add");
        Route::post('/admin/categories/add', "categoryController@saveCategory");

        Route::view('/admin/categories/modify', "admin.categories.update");
        Route::post('/admin/categories/modify/image', "categoryController@modifyCategoryImage");
        Route::post('/admin/categories/modify', "categoryController@modifyCategory");

        Route::get('/admin/categories/delete', "categoryController@deletecategory");


        // orders

        Route::get('/admin/orders', "apController@viewAllOrders");
        Route::get('/admin/orders/cancelled', "apController@viewCancelledOrders");


        Route::get('admin/orders/accept', "ordersController@acceptOrder");
        Route::get('admin/orders/reject', "ordersController@rejectOrder");
        Route::get('admin/orders/ship', "ordersController@shipOrder");
        Route::get('admin/orders/delivered', "ordersController@deliveredOrder");

        Route::view('admin/orders/open', "admin.orders.orderDetails");

        Route::view('admin/orders/shiplabel', "admin.orders.shiplabel");
        Route::view('admin/orders/invoice','admin.orders.invoice');


    Route::group(["middleware" => ['adminOnly']],function(){

        // payments

        Route::get('/admin/payments', "apController@viewAllPayments");
        Route::get('/admin/payments/msrefunded', "apController@payment_msrefunded");


        // customers

        Route::get('/admin/customers', "apController@viewAllCustomers");

        Route::get('/admin/customers/block', "custController@blockCustomer");
        Route::get('/admin/customers/unblock', "custController@unBlockCustomer");
        Route::get('/admin/customers/custdelete', "custController@deleteCustomer");

        // employees

        Route::get('/admin/employees', "apController@viewAllEmployees");

        Route::get('/admin/employees/block', "empController@blockEmployee");
        Route::get('/admin/employees/unblock', "empController@unBlockEmployee");
        Route::get('/admin/employees/custdelete', "empController@deleteEmployee");

        Route::view('/admin/employees/verify', "admin.employees.verify");
        Route::post('/admin/employees/verify', "empController@verifyEmployee");
        Route::get('/admin/employees/delVerRecord', "empController@DeleteVerificationRecordOfEmployee");

        Route::view('/admin/employees/add', "admin.employees.add");
        Route::post('/admin/employees/add', "empController@add");

        Route::view('/admin/employees/update', "admin.employees.update");
        Route::post('/admin/employees/update', "empController@update");

        Route::view('/admin/employees/update/password', "admin.employees.upd_password");
        Route::post('/admin/employees/update/password', "empController@updatePassword");

        Route::view('/admin/employees/view', "admin.employees.empDetails");


    });







});



