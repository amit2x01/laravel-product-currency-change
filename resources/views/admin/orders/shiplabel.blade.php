<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<?php
	$oid = (isset($_GET['oid']))? $_GET['oid'] : 0;

	$orderDetails = DB::table('orders')->where('ord_id', $oid)->where('status', 'Ordered')->where('ord_id', $oid)->orderby('created_at',"DESC")->get()->toarray();

	?>

	@if(count($orderDetails) > 0)
		
	
	
    <title>{{$orderDetails[0]->ord_id}} | Shipping Label</title>
            <?php
				$totalordProducts = DB::table('ordered_products')->where('oid',$orderDetails[0]->ord_id)->get()->toarray();
				$totalordProducts = count($totalordProducts);
				
                $ord_tracking = DB::table('tracking_services')->where('order_id',$orderDetails[0]->ord_id)->get()->toarray();
                $customerDetails = DB::table('customers')->where('cust_id',$orderDetails[0]->cust_id)->get()->toarray();

           	 ?>

        <div class="card p-3" style="width:500px;margin:40px auto;">
            <div class="text-center ">
                <img src="{{asset('img/logo.png')}}" class="img-fluid" style="width: 150px;" alt=""> <br><br>
                    <h3>Order Number: {{ $orderDetails[0]->ord_id }}</h3>

                </div>

				
                <hr>
				
				<br>
                <h4>{{ $customerDetails[0]->cust_name }}</h4>
                <h6><?=  str_replace("State","<br><b>State</b>", str_replace("Country ", "<b> Country </b>", $orderDetails[0]->delivery_address))  ?></h6>
                <br>
                <h5 class="my-2">Order Date: &nbsp&nbsp{{ date('jS M, Y', strtotime($orderDetails[0]->created_at)) }}</h5>
				<h5>Order Amount : <b>Rs. {{ number_format($orderDetails[0]->amount,2) }} &nbsp&nbsp Of &nbsp&nbsp {{ $totalordProducts }} &nbsp Items</b></h5>
                <h5 class="my-2">Delivery Date:&nbsp&nbsp {{ date('jS M, Y', strtotime($ord_tracking[0]->exp_delivery_date)) }}</h5>
                <h5 class="my-2">Drop Zone: &nbsp&nbsp</h5>
				
				@if($orderDetails[0]->payment_mode == "PREPAID")
					<div class="p-3 m-0 border text-center">
						<h1 class="m-0 font-weight-bold">PREPAID</h1>
					</div>
				
				@endif
                <br>
                <img src="{{ asset('phpfile/barcode.php?text=').$orderDetails[0]->ord_id }}" class="img-fluid w-100" alt="">
                <h6 class="text-14 text-center">{{ $orderDetails[0]->ord_id }}</h6>

        </div>


		@else

				<div class="container">
					<div class="text-center">
						<br>
						<img src="{{ asset('img/support/sad.jpg') }}" alt="" class="img-fluid" width="200px">
						<br>
						<h1>Sorry We Unable to find Your Order </h1>
						<br>
					</div>

				</div>

		@endif

