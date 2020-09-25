@extends('customer.layouts.page_layout')

@section('content')
  
  {{-- billing and shipping --}}


  <div class="container my-5">
      
      <div class="card mb-2 d-none d-md-block" >
         <div class="card-body">
             <div class="shipping-steps">
               
                 <span class="active"><i class="fa fa-shopping-cart text-sm">&nbsp&nbsp</i>Items Selected</span>
                 <span class="active"><i class="fa fa-home text-sm">&nbsp&nbsp</i>Delivery Address</span>
                 <span class="active"> <i class="fas fa-credit-card text-sm">&nbsp&nbsp</i>Payment Method</span>
                 <span><i class="fa fa-check text-sm">&nbsp&nbsp</i>Place Order</span>
               
             </div>
         </div>
      </div>

      <div class="card">
         <div class="card-body">
            <div class="p-2">
              <b>Deliver to </b> <br>
              <?=  str_replace("State","<br><b>State</b>", str_replace("Country ", "<b> Country </b>", $address))  ?>
            </div>
         </div>

       
         <form action="{{ url('checkout/order_review')}}" method="post">@csrf
          <h5 class="px-3 bold text-success">Choose Payment Method</h5><br>
           <div class="card">
              <textarea style="visibility: hidden;display: none;" name="address">{{ $address }}</textarea>
               <div class="card-body d-flex align-items-center">
                 <input type="radio" name="pay_mode" value="PREPAID" required> &nbsp&nbsp Cradit/Debit Card Payment 
               </div>
               <div class="card-body d-flex align-items-center">
                 <input type="radio" name="pay_mode" value="POD" required> &nbsp&nbsp Pay On Delivery 
               </div>
               <div class="card-body" style="display: none;" id="btn_next">
                 
                <button class="btn btn-warning px-5" >Next</button>
               </div>
              
           </div>
         </form>

  </div>


<script>
  $('[name=pay_mode]').click(function(){
    $('#btn_next').css('display',"inline-block");
  })

</script>
	
@endsection