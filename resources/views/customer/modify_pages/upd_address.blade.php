@extends('customer.layouts.page_layout')

@section('content')
	<!-- dashboard -->
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							@include('customer.layouts.account_sidebar')
						</div>
						<div class="col-md-8">
							<div class="order-status p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								@if(count($CustAddress) > 0)

								
									<h6 class="bold mb-2">Modify Address Details</h6>
								@else
									<h6 class="bold mb-2">Add New Address</h6>
								@endif

								
								@if(Session::has('update_msg'))
									<div class="alert alert-info m-2">
										{{ Session::get('update_msg') }}
									</div>
                                   @endif
							</div>
							<div class=" p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<form action="{{ url('account/address/modify') }}" method="post">
									@csrf
									<div class="row">
										<div class="col-md-6">

											<?php

												$hno = "";$address = "";$landmark = "";

												if(old('hno')){
													$hno = old('hno');
												}else if(!empty($CustAddress)){
													$hno = $CustAddress[0]['house_no'];
												}

												if(old('address')){
													$address = old('address');
												}else if(!empty($CustAddress)){
													$address = $CustAddress[0]['address'];
												}

												if(old('landmark')){
													$landmark = old('landmark');
												}else if(!empty($CustAddress)){
													$landmark = $CustAddress[0]['landmark'];
												}


											?>


											<label class="bold text-info my-2">House/Flat/Building No.</label>
											<input type="text" name="hno"value="{{$hno}}"  class="form-control">
											@if($errors->has('hno'))
												<span class="d-block text-danger text-16 bold">{{ $errors->first('hno') }}</span>
                                        	@endif
												
											<label class="bold text-info my-2">Address</label>
											<textarea name="address"  class="form-control">{{$address}}</textarea>
											@if($errors->has('address'))
												<span class="d-block text-danger text-16 bold">{{ $errors->first('address') }}</span>
                                        	@endif

											<label class="bold text-info my-2">Landmark <i class="text-sm text-secondary">(Optional)</i></label>
											<input type="text" name="landmark" value="{{$landmark}}" class="form-control">
											

											<label class="bold text-info my-2">Address Type</label>
											<select  class="form-control" name="add_type">

												@if(!empty($CustAddress))
													<option hidden  selected value="{{$CustAddress[0]['address_type']}}">{{$CustAddress[0]['address_type']}}</option>
												@endif
												<option value="Home">Home</option>
												<option value="Commercial/Office">Commercial/Office</option>
											</select>

										</div>
										<div class="col-md-6">


											<?php

												$city = "";$state = "";$pincode = "";$country = "";

												if(old('city')){
													$city = old('city');
												}else if(!empty($CustAddress)){
													$city = $CustAddress[0]['city'];
												}

												if(old('state')){
													$state = old('state');
												}else if(!empty($CustAddress)){
													$state = $CustAddress[0]['state'];
												}

												if(old('pincode')){
													$pincode = old('pincode');
												}else if(!empty($CustAddress)){
													$pincode = $CustAddress[0]['pincode'];
												}

												if(old('country')){
													$country = old('country');
												}else if(!empty($CustAddress)){
													$country = $CustAddress[0]['country'];
												}


											?>
											
											<label class="bold text-info my-2">City</label>
											<input type="text" class="form-control" name="city" value="{{$city}}">
											@if($errors->has('city'))
												<span class="d-block text-danger text-16 bold">{{ $errors->first('city') }}</span>
                                        	@endif

											<label class="bold text-info my-2">State</label>
											<input type="text" class="form-control" name="state" value="{{$state}}">
											@if($errors->has('state'))
												<span class="d-block text-danger text-16 bold">{{ $errors->first('state') }}</span>
                                        	@endif

											<label class="bold text-info my-2">Pincode</label>
											<input type="number" class="form-control" name="pincode" value="{{$pincode}}">
											@if($errors->has('pincode'))
												<span class="d-block text-danger text-16 bold">{{ $errors->first('pincode') }}</span>
                                        	@endif

											<label class="bold text-info my-2">Country</label>
											<input type="text" class="form-control" name="country" value="{{$country}}">
											@if($errors->has('country'))
												<span class="d-block text-danger text-16 bold">{{ $errors->first('country') }}</span>
                                        	@endif
										</div>
									</div>
									<br><br>
									@if(count($CustAddress) > 0)
										<button type="submit" class="btn btn-primary px-3 btn-sm">Update</button>
									@else
										<button type="submit" class="btn btn-primary px-3 btn-sm">+ Add</button>
									@endif
									<a href="{{ url('account/address') }}" class="btn btn-outline-danger btn-sm px-4">Cancel & Back</a>
								</form>
								
								
							</div>
						</div>
					</div>
				</div>
			<!-- !dashboard -->
@endsection