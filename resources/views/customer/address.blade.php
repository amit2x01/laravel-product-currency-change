@extends('customer.layouts.page_layout')

@section('content')
	<!-- dashboard -->
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							@include('customer.layouts.account_sidebar')
						</div>
						<div class="col-md-8">
							<div class=" p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<h6 class="bold mb-2">Your Address</h6>
							</div>
							<div class=" p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								
								<br>

								@if(count($CustAddress) > 0)
	
									<div class="row">
										<div class="col-md-6">
											<b class="text-info bold ">House/Flat/Building No.</b><br> 
											<h5 class="text-16 bold">{{$CustAddress[0]['house_no']}}</h5>
											<b class="text-info bold ">Address</b><br> 
											<h5 class="text-16 bold">{{$CustAddress[0]['address']}}</h5>
											<b class="text-info bold ">Landmark</b><br> 
											<h5 class="text-16 bold">
											{{ ($CustAddress[0]['landmark'] != "" || $CustAddress[0]['landmark'] != NULL)?$CustAddress[0]['landmark']:"Unavailable" }}

											</h5>
											<b class="text-info bold ">Address Type</b>
											<h5 class="text-16 bold">{{ ($CustAddress[0]['address_type'] != "" || $CustAddress[0]['address_type'] != NULL)?$CustAddress[0]['address_type']:"Unavailable" }}</h5>
										</div>
										<div class="col-md-6">
											<b class="text-info bold ">City</b><br> 
											<h5 class="text-16 bold">{{$CustAddress[0]['city']}}</h5>
											<b class="text-info bold ">State</b><br> 
											<h5 class="text-16 bold">{{$CustAddress[0]['state']}}</h5>
											<b class="text-info bold ">Pin/Postal Code</b><br>
											<h5 class="text-16 bold">{{$CustAddress[0]['pincode']}}</h5> 
											<b class="text-info bold ">Country</b>
											<h5 class="text-16 bold">{{$CustAddress[0]['country']}}</h5>
										</div>
									</div>
									<br>
									<a href="{{ url('account/address/modify') }}" class="btn btn-info btn-sm px-4">Update Address</a>
								@else
									<a href="{{ url('account/address/modify') }}" class="btn btn-info btn-sm px-4">Add New Address</a>
								@endif
							</div>
						</div>
					</div>
				</div>
			<!-- !dashboard -->
@endsection