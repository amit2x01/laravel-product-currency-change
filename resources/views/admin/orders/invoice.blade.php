<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<?php
	$oid = (isset($_GET['oid']))? $_GET['oid'] : 0;

	$orderDetails = DB::table('orders')->where('ord_id', $oid)->where('status', 'Ordered')->where('ord_id', $oid)->orderby('created_at',"DESC")->get()->toarray();

	?>

	@if(count($orderDetails) > 0)

    <title>{{$orderDetails[0]->ord_id}} | Invoice</title>
            <?php
                $ord_tracking = DB::table('tracking_services')->where('order_id',$orderDetails[0]->ord_id)->get()->toarray();
                $customerDetails = DB::table('customers')->where('cust_id',$orderDetails[0]->cust_id)->get()->toarray();

           	 ?>

        <div class="card p-5" style="width:950px;margin:40px auto;">
            <div class="text-center ">
                <img src="{{asset('img/logo.png')}}" class="img-fluid" style="width: 150px;" alt=""> <br><br>
                   <h3>Invoice/Bill/Cash Memo</h3>

                </div>


                <hr><br>

                <div class="row">
                    <div class="col-6 ">
                        <h4>Sold By</h4><br>
                        <h6 class="bold">{{ $customerDetails[0]->cust_name }}</h6>
                        <h6>456/4, Demo Web Road. Near ITI. Howrah - 711104<br> West Bengal - India</h6>
                        <br>
                        <b>PAN Number : 1234ABC558</b> <br>
                        <b>GST Number : AS1181234ABC5585Y7FF</b>
                    </div>
                    <div class="col-6 text-right">
                        <h4>Billing Address</h4><br>
                        <h6 class="bold">{{ $customerDetails[0]->cust_name }}</h6>
                        <h6><?=  str_replace("State","<br><b>State</b>", str_replace("Country ", "<b> Country </b>", $orderDetails[0]->delivery_address))  ?></h6>

                    </div>

                </div>
                <br>


                <div class="row">
                    <div class="col-6">
                         <h6 class="my-2"><b>Order Number:</b> &nbsp&nbsp{{ $orderDetails[0]->ord_id }}</h6>
                         <img src="{{ asset('phpfile/barcode.php?text=').$orderDetails[0]->ord_id }}" class="img-fluid" alt="">
                         <h6 class="my-2"><b>Order Date:</b> &nbsp&nbsp{{ date('jS M, Y', strtotime($orderDetails[0]->created_at)) }}</h6>
                    </div>
                    <div class="col-6 text-right">
                         <h6 class="my-2"><b>Invoice Number:</b> &nbsp&nbsp IN {{ $orderDetails[0]->invoice_number }}</h6>
                         <img src="{{ asset('phpfile/barcode.php?text=IN ').$orderDetails[0]->invoice_number }}" class="img-fluid" alt="">
                         <h6 class="my-2"><b>Invoice Date:</b> &nbsp&nbsp{{ date('jS M, Y', strtotime($ord_tracking[0]->under_processed)) }}</h6>
                    </div>
                </div>
                <?php
                    $totalordProducts = DB::table('ordered_products')->where('oid',$orderDetails[0]->ord_id)->get()->toarray();
                    $i = 0;
                ?>
            <br>
                <table class="table table-bordered">
                    <thead class="bold">
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Net Amount <br><span class="text-12">(Including GST (18%))</span> </th>
                        </tr>
                    </thead>


                @foreach($totalordProducts as $products)

                            <tr>
                                <td>{{++$i}}</td>
                                <td>
                                    <h6><a href="{{ url('/products/open?pid=').$products->pid }}" class="text-dark no-underline">{{$products->ptitle}}</a></h6>
                                    <p ><b>Brand:&nbsp</b> {{$products->pbrand}} &nbsp&nbsp <b>Model:&nbsp</b> {{$products->pmodel}} &nbsp&nbsp  </p>


                                </td>
                                <td>{{$products->qty}}</td>
                                <td class='text-right'>Rs. {{number_format($products->price,2)}}</td>

                            </tr>

                    </div>

                @endforeach

                <tr>

                    <td colspan="3" class="bold text-right">Total Amount</td>
                    <td  class=" text-right">Rs. {{number_format($orderDetails[0]->amount,2)}}</td>
                </tr>
                <tr>
                <td colspan="4" class="text-capitalize bold">
                    <h5>In Words</h5>

                    <?php
                        $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
                        echo $f->format($orderDetails[0]->amount);
                    ?>  Only
                </td>
                </tr>
                </table>

                <br><br>
                <div class="text-right">
                    <h6 class="bold">For Demo Web Shopping</h6>
                    <img src="{{ asset('img/support/authorized_signature.png') }}" style="width:100px;" class="img-fluid" alt="">
                    <h6 class="bold">Authorized Signatory</h6>
                </div>



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

