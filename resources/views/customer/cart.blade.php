@extends('customer.layouts.page_layout')

@section('content')
<?php $subtotal = 0; ?>

	<!-- cart -->
            <section class="my-5">
                <div class="container">
                  <h4 class="bold ">Your Cart</h4><br><br>

                  @if(Session::has('msg'))
                    <div class="alert alert-info">
                        <h5>{{Session::get('msg')}}</h5>
                    </div>
                    <br>
                  @endif
            @if(Session::has('shopping_cart') && !empty(Session::get('shopping_cart')))
                  <table class="table table-xs">
                    <tr>
                      <th></th>
                      <th>Description</th>
                      <th class="text-right"></th>
                      <th class="text-right">Price</th>
                      <th class="text-right">Total</th>
                    </tr>
                    
                @foreach(Session::get('shopping_cart') as $product_id => $cart_quantity)
                            <?php
                                $productDetails = DB::table('products')->where('pid',$product_id)->get()->toarray();
                                if(!count($productDetails) > 0):
                                    Session::forget("shopping_cart.".$product_id);

                                else:
                                    $productDetails = $productDetails[0];

                            ?>

                                <tr class="item-row">
                                  <td class="text-center"> <img  src="{{ asset('/').$productDetails->pimage }}" class="cart-pdt-image"></td>
                                  <td>
                                    <p> <strong><a href="{{url('products/open?pid=').$productDetails->pid}}" class="primary-text">{{$productDetails->ptitle}}</a></strong></p>
                                    
                                    <br>
                                    <div class="d-flex">
                                        <a href="{{ url('/cart/remove?pid=').$product_id }}" class="text-danger bold px-3"><i class="fas fa-trash-alt"></i> Remove</a>
                                        
                                    </div>
                                  </td>
                                 <td class="text-center" title="Quantity" >
                                        <div style="width: 150px;">
                                            <div class="input-group" >
                                                <div class="input-group-prepend">
                                                    @if($cart_quantity['Quantity'] > 1)
                                                        <a href="{{url('/cart/decrement?pid=').$product_id}}" class="btn btn-danger px-3 quantity-dec" type="button">-</a>
                                                    @else
                                                        <a href="{{ url('/cart/remove?pid=').$product_id }}" class="btn btn-danger px-3 quantity-dec" type="button"><i class="pt-2 text-sm fa fa-trash"></i></a>
                                                    @endif
                                                </div>
                                                    <input disabled type="text" maxlength="2"  class="bg-light  form-control text-center" value="{{ $cart_quantity['Quantity'] }}" name="quantity">

                                                    

                                                <div class="input-group-append">
                                                    <a href="{{ url('/cart/add?pid=').$product_id }}" class="btn btn-primary px-3 quantity-inc" type="button">+</a>
                                                </div>
                                            </div>
                                        </div>
                                  </td>
                                  <td class="text-right" style="min-width: 120px;" title="Price">
                                  	@if(isset($_COOKIE['curr']))
                                      @if($_COOKIE['curr'] == "INR")
                                        Rs. <?= number_format($productDetails->price,2) ?> &nbsp&nbsp 
                                
                                      @elseif($_COOKIE['curr'] == "USD")
                                        $ <?= number_format($productDetails->price / 74,2) ?> &nbsp&nbsp 
                                
                                      @endif
                                    @else
                                      Rs. <?= number_format($productDetails->price,2) ?> &nbsp&nbsp 
                                    
                                    @endif
                                  </td>
                                  <td class="text-right bold" style="min-width: 120px;" title="Total">
                                   

                                    @if(isset($_COOKIE['curr']))
                                      @if($_COOKIE['curr'] == "INR")
                                        Rs. <?= number_format($cart_quantity['Quantity'] * $productDetails->price,2) ?> &nbsp&nbsp 
                                        <?php $subtotal += $cart_quantity['Quantity'] * $productDetails->price; ?>
                                      @elseif($_COOKIE['curr'] == "USD")
                                        $ <?= number_format(($cart_quantity['Quantity'] * $productDetails->price) / 74,2) ?> &nbsp&nbsp 
                                        <?php $subtotal += ($cart_quantity['Quantity'] * $productDetails->price) / 74; ?>
                                      @endif
                                    @else
                                      Rs. <?= number_format($cart_quantity['Quantity'] * $productDetails->price,2) ?> &nbsp&nbsp 
                                      <?php $subtotal += $cart_quantity['Quantity'] * $productDetails->price; ?>
                                    @endif
                                  </td>

                                  
                                </tr>

                                <?php endif; ?>
                    
                @endforeach
                    <tr class="total-row info my-3" style="background-color: #702496;color:white;font-size: 15px!important;letter-spacing: 0.5px;">
                      <td class="text-right bold w-75" colspan="4">Total</td>
                      <td class="bold text-right">Rs. {{ number_format($subtotal,2) }}</td>
                    </tr>
                  </table>
                  <div class="text-right">
                    <a href="{{ url('/checkout/billing') }}" class="btn btn-primary px-5 border-radius-none checkout-btn-cart-page">Proceed to Checkout</a>
                  </div>
            @else
                <img src="{{asset('img/support/empty_cart.png')}}" class="img-fluid w-25" alt="">
            @endif
                  
                  
                </div>
            </section>
            <!-- !cart -->
@endsection