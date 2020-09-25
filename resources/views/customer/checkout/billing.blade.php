@extends('customer.layouts.page_layout')

@section('content')

  {{-- billing and shipping --}}


  <div class="container my-5">

      <div class="card mb-2 d-none d-md-block">
         <div class="card-body">
             <div class="shipping-steps">

                 <span class="active"><i class="fa fa-shopping-cart text-sm">&nbsp&nbsp</i>Items Selected</span>
                 <span class="active"><i class="fa fa-home text-sm">&nbsp&nbsp</i>Delivery Address</span>
                 <span> <i class="fas fa-credit-card text-sm">&nbsp&nbsp</i>Payment Method</span>
                 <span><i class="fa fa-check text-sm">&nbsp&nbsp</i>Place Order</span>

             </div>
         </div>
      </div>

      <div class="card">
         <div class="card-body">
          <h5 class="px-3 bold text-success">Billing and Shipping</h5><br>
             <form action="{{ url('checkout/payment_method')}}" method="post">
              <div class="row">
                <div class="col-md-6">
                  <?php

                    $address_details = DB::table('cust_addresses')->where('cust_id',Session::get('cust_logged_id'))->get()->toarray();

                    if(count($address_details) > 0){

                      $hno = $address_details[0]->house_no;
                      $add = $address_details[0]->address;
                      $city = $address_details[0]->city;
                      $state = $address_details[0]->state;
                      $pincode = $address_details[0]->pincode;
                      $country = $address_details[0]->country;

                      $landmark = $address_details[0]->landmark;

                    }else{
                      $hno = "";
                      $add = "";
                      $city = "";
                      $state = "";
                      $pincode = "";
                      $country = "";

                      $landmark = "";
                    }

                  ?>
                @csrf

                  <label class="my-2"><b>House/Flat/Building No <b class="text-danger text-14">*</b></b></label>
                  <input type="text"  class="form-control" name="hno"    value="{{$hno}}">

                  @if($errors->has('hno'))
                        <span class="d-block text-danger text-16 bold">{{ $errors->first('hno') }}</span>
                  @endif


                  <label class="my-2"><b>Address <b class="text-danger text-14">*</b></b></label>
                  <textarea name="address" class="form-control">{{$add}}</textarea>

                  @if($errors->has('address'))
                        <span class="d-block text-danger text-16 bold">{{ $errors->first('address') }}</span>
                  @endif


                  <label class="my-2"><b>Pin Code <b class="text-danger text-14">*</b></b></label>
                  <input type="text"  class="form-control" name="pin"  value="{{$pincode}}">

                  @if($errors->has('pin'))
                        <span class="d-block text-danger text-16 bold">{{ $errors->first('pin') }}</span>
                  @endif



                  <label class="my-2"><b>City <b class="text-danger text-14">*</b></b></label>
                  <input type="text"  class="form-control" name="city"  value="{{$city}}">

                  @if($errors->has('city'))
                        <span class="d-block text-danger text-16 bold">{{ $errors->first('city') }}</span>
                  @endif



                  <label class="my-2"><b>State <b class="text-danger text-14">*</b></b></label>
                  <input type="text"  class="form-control" name="state"  value="{{$state}}">

                  @if($errors->has('state'))
                        <span class="d-block text-danger text-16 bold">{{ $errors->first('state') }}</span>
                  @endif


                  <label class="my-2"><b>Country <b class="text-danger text-14">*</b></b></label>
                  <input type="text"  class="form-control" name="country"  value="{{$country}}">

                  @if($errors->has('country'))
                        <span class="d-block text-danger text-16 bold">{{ $errors->first('country') }}</span>
                  @endif

                </div>
                <div class="col-md-6">


                </div>
              </div>
              <br>
              <button class="btn btn-warning px-5">Next</button>
             </form>
         </div>

  </div>

@endsection
