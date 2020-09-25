@extends('customer.layouts.page_layout')
@section('content')

<!-- orders  -->
<?php
$custId= Session::get('cust_logged_id');
$orders = DB::table('orders')->where('cust_id', $custId)->orderby('created_at',"DESC")->get()->toarray();
?>

    <div class="container my-5 px-4">
        <div id="orders">
            <h6 class="bold mb-2">Your Orders</h6><br>
            @if(count($orders) > 0)
            @foreach($orders as $order)
                <div class="row p-3 my-2" style="box-shadow:  0 0 2px rgba(0,0,0,0.4577);">
                    <div class="col-md-6">
                        <h4 class="bold d-flex align-items-center">ORD {{$order->ord_id}} &nbsp&nbsp
                        @if($order->payment_mode == "PREPAID")
                            <span class="text-12 bold bg-success text-light px-2 py-1">PREPAID</span>
                        @elseif($order->payment_mode == "Pay On Delivery")
                            <span class="text-12 bold bg-warning text-light px-2 py-1">POD</span>
                        @endif
                        </h4>
                        <h6><b>Total Items :</b>
                        <?php
                            $totalordProducts = DB::table('ordered_products')->where('oid',$order->ord_id)->get()->toarray();
                            echo count($totalordProducts);
                        ?>
                        </h6>
                        <br>
                        <h5 class="text-14"><b>Order Tracking Status : </b> &nbsp&nbsp
                        <?php
                            $ord_tracking = DB::table('tracking_services')->where('order_id',$order->ord_id)->get()->toarray();

                        ?>
                        @if($order->status == "Cancelled")
                            <span class="text-danger bold">Cancelled</span></h5>
                            <h6>If the payment already made, We Refund Your Money within 4 Working days</h6>
                            <p>Please Check your Online payment status (Only for PREPAID Orders). <span class="bold text-primary">Account > Payments</span></p>
                        @else
                            @if(count($ord_tracking) > 0)

                                @if($ord_tracking[0]->delivered != NULL)
                                    <span class="text-info bold">Delivered On {{ date("jS M, Y", strtotime($ord_tracking[0]->delivered)) }}</span></h5>
                                @elseif($ord_tracking[0]->dispatched != NULL)
                                    <span class="text-info bold">Dispatched On {{ date("jS M, Y", strtotime($ord_tracking[0]->dispatched)) }}</span></h5>
                                @elseif($ord_tracking[0]->under_processed != NULL)
                                    <span class="text-info bold">Under Process</span></h5>
                                @else
                                    <span style="color:orangered" class="bold">Order Placed On {{ date("jS M, Y", strtotime($order->created_at)) }}</span></h5>
                                @endif

                            @endif
                        @endif
                        <br>

                    </div>
                    <div class="col-md-6 text-right order-control">
                        @if($order->status != "Cancelled")
                            <div>
                                <a href="{{ url('/orders/view?oid=').$order->ord_id }}" class="btn px-5 my-2 btn-light">View Details</a>
                            </div>

                            @if($ord_tracking[0]->delivered != NULL)
                                {{-- No action --}}
                            @elseif($ord_tracking[0]->dispatched != NULL || $ord_tracking[0]->under_processed != NULL )
                                <div onclick="alert('For Cancel Your Order, Please Contact our helpline.')">
                                    <a href="#" class="btn px-5 my-2 btn-light disabled" >Cancel Order</a>
                                </div>

                            @else
                                <div>
                                    <p data-id="{{$order->ord_id}}" class="btn px-5 my-2 btn-danger cancelOrder">Cancel Order</p>
                                </div>
                            @endif
                        @else

                            @if($order->payment_mode == "PREPAID")
                                <div>
                                <a href="{{ url('/account/payments_history') }}" class="btn btn-info px-5">check Refund Status</a>
                                </div>
                            @endif

                        @endif

                    </div>
                </div>
            @endforeach
            @else
            <div class="text-center my-5 py-3">
                <img src="{{ asset('img/support/no_orders.png') }}" class="img-fluid w-50" style="max-width: 400px;" alt="">
                <br>
                <h1>You don't have any orders</h1>
            </div>
            @endif
        </div>
    </div>


<script>
    $('.cancelOrder').click(function(){
        swal({
            title: "Are You sure?",
            text: 'Your Orders will be cancelled.',

            buttons: true,
        })
        .then((value) => {
          if(value == true){
            var data_id = $(this).attr('data-id');

            window.location = `<?= url('/') ?>`+"/"+`orders/cancel?oid=${data_id}`;
          }
        });
    })
</script>
<!-- !orders  -->
@endsection
