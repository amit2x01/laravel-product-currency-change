@extends('customer.layouts.page_layout')

@section('content')
	<!-- HOMEPAGE BANNER -->
    <style>

    </style>
	<section>
		<div class="homepage-banner">
			<div class="container">
				<div class="row">
					<?php
						$productsbrands = DB::table('products')->select('brand')->groupby("brand")->get();
					?>
					<div class="col-md-4">
						<!-- search car -->
						<ul class="nav nav-tabs search-car-tab">
							<li class="active"><a data-toggle="tab" class="click_on_load active show" href="#sch_car">By CAR</a></li>
							<li><a data-toggle="tab" href="#sch_vin">By VIN</a></li>
						</ul>
						<div class="tab-content p-3">
							<div id="sch_car" class="tab-pane fade active show">
								<form action="{{ url('/products/filter/bycar') }}" method="get">
									<select name="brand" id="car_brands_search_model" class="w-100 custom-select custom-select-with-search form-control">
										<option value=''   selected>Select Car Make</option>
										@foreach($productsbrands as $brand)
											<option value="{{$brand->brand}}">{{$brand->brand}}</option>
										@endforeach
									</select>
									<br><br>
									<div id="car_models" class="drop-arrow-search-homepage">
										<select  name="model" class="w-100 custom-select  form-control" disabled>
											<option value='' hidden selected>Select Model Line</option>

										</select>
									</div>

									<br><br>
									<button type="submit" class="btn btn-primary btn-block no-underline">Search</button>
								</form>
							</div>
							<div id="sch_vin" class="tab-pane fade">
								<form action="{{ url('/') }}" method="post">
									<select name="" id="" class="custom-select custom-select-with-search  form-control">
										<option value=''>Select Car Make</option>
										@foreach($productsbrands as $brand)
											<option value="{{$brand->brand}}">{{$brand->brand}}</option>
										@endforeach
									</select>
									<br><br>
									<input type="text" placeholder="Enter VIN" class="form-control">
									<br>
									<button type="submit" class="btn btn-primary btn-block no-underlin disabled " disabled>Coming Soon</button>
								</form>
							</div>
						</div>
						<!-- end -- search car -->
					</div>
					<div class="col-md-8">
						<img src="{{ asset('img/support/homepage-header.jpg') }}" class="img-fluid w-100" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php

		$categories = DB::table('categories')->get()->toarray();

	?>

	@if(count($categories) > 0)
	<!-- SHOP BY CATEGORIES -->
	<section>
		<div class="shop-by-categories my-5 center">
			<div class="heading-panel">
				<h4 class="bold primary-text">SHOP BY CATEGORIES</h1>
				<p class="secondary-text text-14">TOP SELLING COLLECTION</p>
			</div>
			<div class="container px-3 my-4">
				<div class="owl-carousel px-3 owl-theme position-relative">



				@foreach($categories as $Category)
					<div class="item">
						<div class="card categories-list">
							<img src="{{ asset($Category->cate_img) }}" class="card-back-img">
							<div class="card-label">
								<b>{{$Category->cate_name}}</b><br>
								<?php $cate_products_count = DB::table('products')->where('category_id', $Category->cate_id)->get()->toarray(); ?>

								<span>{{ count($cate_products_count) }} Prodcuts</span>
								<br>
								<a  href="{{ url('/products/filter/Category?cate_id=').$Category->cate_id }}" class="no-underline border-radius-none btn btn-purple px-5 my-3 text-light">Shop Now</a>
							</div>
						</div>
					</div>

				@endforeach



				</div>
			</div>
		</div>
	</section>
	@endif

	<section>
		<div class="hot-deals my-5 center">
			<div class="heading-panel">
				<h4 class="bold primary-text">HOT DEALS</h1>
				<p class="secondary-text text-14">EVERY TIME TOP</p>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<?php

					$products = DB::table('products')->limit(3)->orderby("created_at",'desc')->get();
				?>
				@foreach( $products as $product )
					<div class="col-md-4">
						<div class="card products-card">
							<a href="{{ url('/products/open?pid=').$product->pid }}" class="no-underline">
								<img src="{{ asset('/').$product->pimage }}"   class="card-img" style="height:300px;">


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
				@endforeach


			</div>
		</div>
	</section>


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
		$('#car_brands_search_model').change(function(){
			$('#car_models select').attr('disabled','disabled');
			$.ajax({
				url: "<?php echo url('get/brands/select/options'); ?>",
				method: "GET",
				data: {'brand':$(this).val()},
				success: function(e){
					document.getElementById('car_models').innerHTML = "";

					document.getElementById('car_models').innerHTML += e;

				}
			});

		})

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
