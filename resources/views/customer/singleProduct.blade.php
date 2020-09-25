@extends('customer.layouts.page_layout')

@section('content')


<?php

	$pid = ($_GET['pid'])?$_GET['pid']:1;

	$product_info = DB::table('products')->where('pid',$pid)->get()->toarray();


?>

	@if(count($product_info) > 0) <?php $product_info = $product_info[0] ?>

			<!-- product details -->
				<section class="my-5">
					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<div class="product-image text-center" >
									<img src="{{ asset('/').$product_info->pimage }}" alt="" class="img-fluid w-100" style="height: 300px;">
								</div>

							</div>
							<div class="col-md-6">
								<h3 class="mb-2">{{$product_info->ptitle}}</h3>
								@if(isset($_COOKIE['curr']))
										@if($_COOKIE['curr'] == "INR")
											Rs. <?= number_format($product_info->price,2) ?> &nbsp&nbsp 
											<del class="text-danger">
												RS. <?= number_format($product_info->MRP,2) ?>
											</del></h6>
										@elseif($_COOKIE['curr'] == "USD")
											$ <?= number_format($product_info->price / 74,2) ?> &nbsp&nbsp 
											<del class="text-danger">
												$ <?= number_format($product_info->MRP / 74,2) ?>
											</del></h6>
										@endif
									@else
										Rs. <?= number_format($product_info->price,2) ?> &nbsp&nbsp 
										<del class="text-danger">Rs. <?= number_format($product_info->MRP,2) ?></del></h6>
									@endif
                                </h6>
								<br><br>
								<div class="row justify-content-center">
                                    <div class="col-md-4 col-6 text-center bold">
                                        <i class="fa fa-recycle fa-2x text-warning"></i>
                                        <p class="text-center">7 Day's <br> Replacement</p>
                                    </div>
                                    <div class="col-md-4 col-6 text-center bold">
                                        <i class="fa fa-truck fa-2x text-info"></i>
                                        <p class="text-center">3 - 4 Day's <br>Fast Delivery</p>
                                    </div>
                                    <div class="col-md-4 col-6 text-center bold">
                                        <i class="fa fa-check fa-2x text-success"></i>
                                        <p class="text-center">100% <br> Original Product</p>
                                    </div>
                                </div>
								<br><br>
								<h6 class="bold text-primary">
									Product Info
								</h4>
								<br>

								<p><?= $product_info->pshortdesc ?></p>

								<br>
							<form action="{{ url('/cart/add') }}" method="get" style="width: 150px;">
                                <label class="bold">Quantity</label><br>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger px-3 quantity-dec" type="button">-</button>
                                    </div>
                                    	<input type="hidden" name="quantityUpdated" value="true">
                                    	<input type="hidden" name="pid" value="{{$product_info->pid}}">
                                        <input type="text" maxlength="2"  class="quantity-input form-control text-center" value="1" name="quantity">



                                    <div class="input-group-append">
                                        <button class="btn btn-primary px-3 quantity-inc" type="button">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-dark border-radius-none  px-5 my-2">Add to Cart</button>
                            </form>
							</div>
						</div>
						<br><br>
						<div class="row">
							<div class="col-md-12">
								<b class="bold text-info">Product Description</b>
                                <br><br>
                                <p><?= $product_info->pdesc ?></p>
							</div>
							<div class="col-md-12">
								<b class="bold text-info">Product Extra Information</b>
                                <br><br>
                                <table class="table table-borderless ">
                                   <tr>
	                                   	<th>Brand</th>
	                                   	<td>{{ $product_info->brand }}</td>
                                   </tr>
                                   <tr>
	                                   	<th>Model</th>
	                                   	<td>{{ $product_info->model }}</td>
                                   </tr>
                                </table>
							</div>
						</div>
					</div>
				</section>
			<!-- !end -- product details -->

		@else

			<center><br>
				<img src="{{ asset('img/support/sad.jpg') }}" alt="" class="img-fluid" width="200px">
				<br>
				<h1>Sorry We Unable to find Your product </h1>
				<br>
			</center>

		@endif


@endsection
