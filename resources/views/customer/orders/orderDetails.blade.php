@extends('customer.layouts.page_layout')

@section('content')


	<?php
	$oid = (isset($_GET['oid']))? $_GET['oid'] : 0;

	$orderDetails = DB::table('orders')->where('cust_id', Session::get('cust_logged_id'))->where('status', 'Ordered')->where('ord_id', $oid)->orderby('created_at',"DESC")->get()->toarray();

	?>

	@if(count($orderDetails) > 0)

			<?php
                $ord_tracking = DB::table('tracking_services')->where('order_id',$orderDetails[0]->ord_id)->get()->toarray();


           	 ?>

			<!-- orders details -->
				<div class="container my-5">
					<div class="row">
						<div class="col-lg-4">
							<div class="order-status p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<h6 class="bold ">Order Status</h6>

								<h5 class="bold text-info" >
									@if($ord_tracking[0]->delivered != NULL)
			                            <span class="text-info bold">Order Delivered</span></h5>
			                        @elseif($ord_tracking[0]->dispatched != NULL)
			                            <span class="text-info bold">Dispatched</span></h5>
			                        @elseif($ord_tracking[0]->under_processed != NULL)
			                            <span class="text-info bold">Under Process</span></h5>
			                        @else
			                            <span style="color:orangered" class="bold">Order Placed</span></h5>
			                        @endif
								</h2>

								@if($ord_tracking[0]->delivered == NULL)
								<br>
								<h6 class="text-danger bold"><b class="text-info">Expected Delivery Date</b> <br> {{date("jS M, Y ( l )",strtotime($ord_tracking[0]->exp_delivery_date))}}</h5>
								@endif

							</div>


							<div id="order-details" class=" p-4 my-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<h6 class="bold mb-2">Order Details</h6>
								<table class="table table-borderless">

									<tr>
										<td class="w-50 text-14">Order Number</td>
										<th class="w-50 text-14">#{{$orderDetails[0]->ord_id}}</th>
									</tr>
									<tr>
										<td class="w-50 text-14">Order Date</td>
										<th class="w-50 text-14">{{date('jS M, Y', strtotime($orderDetails[0]->created_at))}}</th>
									</tr>
									<tr>
										<td class="w-50 text-14">Invoice Number</td>
										@if($orderDetails[0]->invoice_number != NULL)
										<th class="w-50 text-14">IN {{$orderDetails[0]->invoice_number}}</th>
										@endif
									</tr>
									<tr>
										<td>Amount</td>
										<th class="w-50 text-14">
											@if(isset($_COOKIE['curr']))
												@if($_COOKIE['curr'] == "INR")
												Rs. <?= number_format($orderDetails[0]->amount,2) ?> &nbsp&nbsp 
												
												@elseif($_COOKIE['curr'] == "USD")
												$ <?= number_format($orderDetails[0]->amount / 74,2) ?> &nbsp&nbsp 
												
												@endif
											@else
												Rs. <?= number_format($orderDetails[0]->amount,2) ?> &nbsp&nbsp 
												
											@endif
										</th>
									</tr>
									<tr>
										<td class="w-50 text-14">Payment Mode</td>
										<th class="w-50 text-14">{{$orderDetails[0]->payment_mode}}</th>
									</tr>
								</table>
							</div>

						</div>
						<div class="col-lg-8">
							<div id="tack-order" class=" p-4" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<h6 class="bold">Tracking Orders</h6>
								<div class="tracking-steps">

									<div class="tracking-step text-center">
										<div class="track-icon active"></div>
										<div class="caption text-md-center text-left">
											Ordered
											<p class="text-secondary text-sm">
												{{date('jS M, Y h:i:A', strtotime($orderDetails[0]->created_at))}}
											</p>
										</div>
									</div>
									<div class="line"></div>
									<div class="tracking-step text-center">
										@if($ord_tracking[0]->under_processed != NULL)
										<div class="track-icon active"></div>
										<div class="caption text-md-center text-left">
											Under Process
											<p class="text-secondary text-sm">
												{{date('jS M, Y h:i:A', strtotime($ord_tracking[0]->under_processed))}}
											</p>
										</div>
										@else
										<div class="track-icon"></div>
										<div class="caption text-md-center text-left">
											Under Process
											<p class="text-secondary text-sm">&nbsp</p>
										</div>
										@endif
									</div>

									<div class="line"></div>
									<div  class="tracking-step text-center">
										@if($ord_tracking[0]->dispatched != NULL)
										<div class="track-icon active"></div>
										<div class="caption text-md-center text-left">
											Shipped
											<p class="text-secondary text-sm">
												{{date('jS M, Y h:i:A', strtotime($ord_tracking[0]->dispatched))}}
											</p>
										</div>
										@else
										<div class="track-icon"></div>
										<div class="caption text-md-center text-left">
											Shipped
											<p class="text-secondary text-sm">&nbsp</p>
										</div>
										@endif
									</div>

									<div class="line"></div>
									<div class="tracking-step text-center">
										@if($ord_tracking[0]->delivered != NULL)
										<div class="track-icon active"></div>
										<div class="caption text-md-center text-left">
											Delivered
											<p class="text-secondary text-sm">
												{{date('jS M, Y h:i:A', strtotime($ord_tracking[0]->delivered))}}
											</p>
										</div>
										@else
										<div class="track-icon"></div>
										<div class="caption text-md-center text-left">
											Delivered
											<p class="text-secondary text-sm">&nbsp</p>
										</div>
										@endif
									</div>

								</div>
							</div>


                            <div id="delivery_address" class="my-3 p-4" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
                                @if($ord_tracking[0]->delivered == NULL)
                                    <h3>Deliver to </h3> <br>
                                @else
                                    <h3>Delivered Address</h3> <br>
                                @endif
                                 <?=  str_replace("State","<br><b>State</b>", str_replace("Country ", "<b> Country </b>", $orderDetails[0]->delivery_address))  ?>
                                 <br><br>
                                 @if($ord_tracking[0]->delivered == NULL)
                                 <div class="alert alert-success text-14">
                                    <b>Important!</b>  &nbsp&nbsp If you want to change delivery address, please contact us on our helpline number or mail us.
                                 </div>
                                 @endif
                            </div>

                            <?php
									$totalordProducts = DB::table('ordered_products')->where('oid',$orderDetails[0]->ord_id)->get()->toarray();
								?>

							<div id="ordered-items" class="my-3 p-4" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<h6>Ordered Items ({{count($totalordProducts)}})</h6><br>
								@foreach($totalordProducts as $products)

								<div class="row ">
									<div class="col-md-3 text-center">

										<?php $product_info = DB::table('products')->where('pid',$products->pid)->get()->toarray(); ?>
										@if(count($product_info) > 0)
											<img src="{{ asset($product_info[0]->pimage) }}" class="img-fluid" style="width:100px" alt="">
										@else
											<img src="{{ asset('img/support/no_image.png') }}" class="img-fluid" style="width:100px" alt="">
										@endif
									</div>
									<div class="col-md-9">
										<h5><a href="{{ url('/products/open?pid=').$products->pid }}" class="text-dark no-underline">{{$products->ptitle}}</a></h5>
                                        <p class="text-danger"><b class="text-primary">Brand:&nbsp</b> {{$products->pbrand}} &nbsp&nbsp <b class="text-primary">Model:&nbsp</b> {{$products->pmodel}} &nbsp&nbsp  </p>
                                        <br>
										<p><b>Qty:&nbsp</b> {{$products->qty}} &nbsp&nbsp <b>Price: &nbsp</b> 
											@if(isset($_COOKIE['curr']))
												@if($_COOKIE['curr'] == "INR")
												Rs. <?= number_format($products->price,2) ?> &nbsp&nbsp 
												
												@elseif($_COOKIE['curr'] == "USD")
												$ <?= number_format($products->price / 74,2) ?> &nbsp&nbsp 
												
												@endif
											@else
												Rs. <?= number_format($products->price,2) ?> &nbsp&nbsp 
												
											@endif
										</p>
									</div>
								</div>
								@endforeach
							</div>
						</div>

					</div>

				</div>
			<!-- !orders details -->

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




@endsection
