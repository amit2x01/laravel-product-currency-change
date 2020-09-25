@extends('customer.layouts.page_layout')

@section('content')

	<div class="container">
    <br><br>
	@if(count($products) > 0)
		<div class="row">

			@foreach($products as $product)
				<div class="col-md-4 col-6 ">
					<div class="card">
						<div class="card products-card">
							<a href="{{ url('/products/open?pid=').$product->pid }}" class="no-underline">
								<img src="{{ asset('/').$product->pimage }}"   class="card-img" >


								<div class="card-body py-3 text-dark bold prodcut-card-name">
									<p>{{ $product->ptitle }}</p>
									<br>
									@if(isset($_COOKIE['curr']))
										@if($_COOKIE['curr'] == "INR")
											Rs. <?= number_format($product->price,2) ?> &nbsp&nbsp 
											<del class="text-danger">
												RS. <?= number_format($product->MRP,2) ?>
											</del></h6>
										@elseif($_COOKIE['curr'] == "USD")
											$ <?= number_format($product->price / 74,2) ?> &nbsp&nbsp 
											<del class="text-danger">
												$ <?= number_format($product->MRP / 74,2) ?>
											</del></h6>
										@endif
									@else
										Rs. <?= number_format($product->price,2) ?> &nbsp&nbsp 
										<del class="text-danger">Rs. <?= number_format($product->MRP,2) ?></del></h6>
									@endif
								</div>
								<br>
								<div class="card-footer d-block d-sm-none">
									<a href="{{ url('/cart/add?pid=').$product->pid }}" class="btn btn-warning btn-block "> Add to Cart </a>

								</div>
							</a>
							<div class="product-functions">
								<a href="{{ url('/cart/add?pid=').$product->pid }}" class="no-underline fas fa-shopping-cart border-right"> <i class="fa fa-plus text-sm"></i></a>
								<a  class="no-underline far fa-eye quick-view-item" style="cursor: pointer;" data-toggle="modal" data-target="#product-modal"  data-pid="{{$product->pid}}" ></a>
							</div>

							@if($product->MRP > $product->price)
								<span class="sale text-12">-
									<?php
										$discount = $product->MRP - $product->price;
										$discount = ($discount * 100) / $product->MRP;
										echo number_format($discount,0)
									?>%
								</span>
							@endif
						</div>
					</div>
				</div>
			@endforeach


		</div>
		<br><br>

			<div class="pagination ">
				{{ $products->links() }}
			</div>

		<br><br>

		@else

			<center><br>
				<img src="{{ asset('img/support/sad.jpg') }}" alt="" class="img-fluid" width="200px">
				<br>
				<h1>Sorry We Can't find any products </h1>
				<br>
			</center>

		@endif
	</div>




<div class="modal fade" id="product-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product-modal-label">Product Quick View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="product_data_model" style="overflow:auto; max-height: 300px">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       <a href="#" id="add-to-cart" class="btn btn-warning">Add to cart</a>
      </div>
    </div>
  </div>
</div>


<script>
	$('.quick-view-item').click(function(){
			var pid = $(this).attr('data-pid');
			$('#product_data_model').html("Loading ..........");

			$('#add-to-cart').attr('href', "<?= url('/cart/add?pid=') ?>"+pid);
			$.ajax({
				url: "<?= url('/') ?>"+"/products/js/quickView",
				method: "GET",
				data: {"pid":pid},
				success: function (e){
					$('#product_data_model').html(e);
				}
			});

		});

</script>

@endsection
