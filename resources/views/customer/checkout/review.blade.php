@extends('customer.layouts.page_layout')

@section('content')
  
  {{-- billing and shipping --}}


  <div class="container my-5">
      
      <div class="card mb-2 d-none d-md-block">
         <div class="card-body">
             <div class="shipping-steps">
               
                 <span class="active"><i class="fa fa-shopping-cart text-sm">&nbsp&nbsp</i>Items Selected</span>
                 <span class="active"><i class="fa fa-home text-sm">&nbsp&nbsp</i>Delivery Address</span>
                 <span class="active"> <i class="fas fa-credit-card text-sm">&nbsp&nbsp</i>Payment Method</span>
                 <span class="active"><i class="fa fa-check text-sm">&nbsp&nbsp</i>Place Order</span>
               
             </div>
         </div>
      </div>

      <div class="row">
        <div class="col-md-7">
          <h5 class="px-3 bold text-success">Review Orders</h5><br>
          <div class=" p-2">
            <?php $subtotal = 0; ?>
            <div class="row">
              @foreach(Session::get('shopping_cart') as $product_id => $cart_quantity)
              <?php
              $productDetails = DB::table('products')->where('pid',$product_id)->get()->toarray();
              if(!count($productDetails) > 0):
              Session::forget("shopping_cart.".$product_id);
              else:
              $productDetails = $productDetails[0];
              ?>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header text-center" style="background-color: #fff!important;">
                    <img  src="{{ asset('/').$productDetails->pimage }}" class="img-fluid" style="width:125px">
                  </div>
                  <div class="card-body">
                    {{$productDetails->ptitle}} <br> <b><span class="text-info">Brand :</span> {{$productDetails->brand}}</b> <b><span class="text-info">Model :</span> {{$productDetails->model}}</b>
                  </div>
                  <div class="card-footer d-flex justify-content-between" style="background-color: #fff!important;">
                    <span><b>Qty: &nbsp</b> {{$cart_quantity['Quantity']}}</span>
                    <span><b>Price: &nbsp</b>
                      @if(isset($_COOKIE['curr']))
                        @if($_COOKIE['curr'] == "INR")
                          Rs. <?= number_format($productDetails->price,2) ?> &nbsp&nbsp 
                          
                        @elseif($_COOKIE['curr'] == "USD")
                          $ <?= number_format($productDetails->price / 74,2) ?> &nbsp&nbsp 
                          
                        @endif
                      @else
                        Rs. <?= number_format($productDetails->price,2) ?> &nbsp&nbsp 
                        
                      @endif
                    </span>
                  </div>
                </div>
              </div>
              <?php $subtotal += $cart_quantity['Quantity'] * $productDetails->price; ?>
              
              <?php endif; ?>
              
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card p-2">
            <div class="card-header">
              <b>Deliver To</b>
              <br>
              <p><?=  str_replace("State","<br><b>State</b>", str_replace("Country ", "<b> Country </b>", $address))  ?></p>
              <br>
              <b>Timing</b>
              <br>
              <span class="text-success bold">
                10am to 7pm - {{ date('d M Y ( l )', strtotime("+4 day")) }}
              </span>
            </div>

            <div class="card-body">
              <h6 class="d-flex justify-content-between"><b>Order Total : </b>
              <b class="my-2">
              @if(isset($_COOKIE['curr']))
                @if($_COOKIE['curr'] == "INR")
                  Rs. <?= number_format($subtotal,2) ?> &nbsp&nbsp 
                  
                @elseif($_COOKIE['curr'] == "USD")
                  $ <?= number_format($subtotal / 74,2) ?> &nbsp&nbsp 
                  
                @endif
              @else
                Rs. <?= number_format($subtotal,2) ?> &nbsp&nbsp 
                
              @endif
              </b></h6>
              <h6 class="d-flex justify-content-between"><b>Shipping Charges :</b> 
              <b class="my-2"><span class="text-success bold">FREE</span></b></h6>
              <h6 class="d-flex justify-content-between"><b>Total :</b> 
              <b class="my-2">
              @if(isset($_COOKIE['curr']))
                @if($_COOKIE['curr'] == "INR")
                  Rs. <?= number_format($subtotal,2) ?> &nbsp&nbsp 
                  
                @elseif($_COOKIE['curr'] == "USD")
                  $ <?= number_format($subtotal / 74,2) ?> &nbsp&nbsp 
                  
                @endif
              @else
                Rs. <?= number_format($subtotal,2) ?> &nbsp&nbsp 
                
              @endif
              </b></h6>
            </div>

            <div class="card-body">
              <h6>Payment Method</h6>
              <b><?php

                  if($pay_mode == "PREPAID"){
                    echo "Online Payment Via Cradit/Debit Cards.";

                    ?>
                    <br><br>
                    <form action="{{ url('checkout/payorder') }}" method="POST" >
                       <textarea style="visibility: hidden;display: none;" name="address">{{ $address }}</textarea>
                        <input type="hidden" name="pay_mode" value={{$pay_mode}}>
                    @csrf

                      <b>Card Number</b>
                      <input type="text" maxlength="16" name="cnum" class="form-control">

                      @if($errors->has('cnum'))
                        <span class="d-block text-danger text-16 bold">{{ $errors->first('cnum') }}</span>
                      @endif

                      <div class="row">
                        <div class="col-md-8">
                          <b>Card Exp</b>
                          <input type="month" name="cexp" class="form-control">

                          

                        </div>
                        <div class="col-md-4">
                          <b>CVV</b>
                          <input type="password" name="cvv" class="form-control">

                          

                        </div>
                      </div>

                      @if($errors->has('cexp'))
                            <span class="d-block text-danger text-16 bold">{{ $errors->first('cexp') }}</span>
                      @endif
                      @if($errors->has('cvv'))
                            <span class="d-block text-danger text-16 bold">{{ $errors->first('cvv') }}</span>
                      @endif

                      <b>Card Holder</b>
                      <input type="text" name="cholder" class="form-control">

                      @if($errors->has('cholder'))
                            <span class="d-block text-danger text-16 bold">{{ $errors->first('cholder') }}</span>
                      @endif

                      <br><br>
                      <button type="submit" class="btn btn-block btn-warning">Pay & Place Order</button>

                    </form>

                    <?php

                  
                  }else if($pay_mode == "POD"){
                    echo "Pay On Delivery (Cash or Card)";
                     ?>
                      <form action="{{ url('checkout/placeorder') }}" method="POST" >
                       <textarea style="visibility: hidden;display: none;" name="address">{{ $address }}</textarea>
                        <input type="hidden" name="pay_mode" value={{$pay_mode}}>
                    @csrf

                      <br><br>
                      <button type="submit" class="btn btn-block btn-warning"> Place Order</button>

                    </form>

                     <?php
                  }

              ?></b>


              <br><br>


            </div>
          </div>
        </div>
      </div>  

  </div>


	
@endsection