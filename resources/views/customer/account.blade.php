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
								<h6 class="bold mb-2">Your Account</h6>
								<br>
								<div class="row">
									<div class="col-6 text-center border-right">
										<a href="{{ url('account/payments_history') }}" class="no-underline"><i class="fas fa-credit-card fa-2x"></i>  <h4 class=" text-14 py-2 bold text-dark">Payments</h4></a>
									</div>
									<div class="col-6 text-center">
										<a href="{{ url('/orders') }}" class="no-underline"><i class="fas fa-book fa-2x"></i>  <h4 class=" bold text-14 py-2 text-dark">Orders</h4></a>
									</div>
								</div>
							</div>
							<div class="order-status p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<div class="row">
									<div class="col-md-6">
										<p class="text-secondary bold mb-3">Login Information</p>
										<h6 class="mb-2">
											<b class="text-info">Email</b><br>
											<b>{{ $customerDetails['cust_email'] }}</b> 
										</h6>
										<h6 class="mb-2">
											<b class="text-info">Phone</b><br>
											<b>+91 {{ $customerDetails['cust_phone'] }}</b> 
										</h6>
									</div>
									<div class="col-md-6">
										<p class="text-secondary bold mb-3">Personal Information</p>
										<h6 class="mb-2">
											<b class="text-info">Name</b><br>
											<b>{{ $customerDetails['cust_name'] }}</b> 
										</h6>
										<h6 class="mb-2">
											<b class="text-info">Date of Birth</b><br>
											<b>{{ (isset($customerDetails['cust_dob'])) ? date('d - M - Y',strtotime($customerDetails['cust_dob'])) : "--" }}</b> 
										</h6>
										<h6 class="mb-2">
											<b class="text-info">Gender</b><br>
											<b>{{ $customerDetails['cust_gender'] ?? "--" }}</b> 
										</h6>
									</div>
								</div>
								<br>
								<a href="{{ url('account/modify') }}" class="btn btn-outline-info btn-sm px-4">Modify</a>
							</div>
						</div>
					</div>
				</div>
			<!-- !dashboard -->
@endsection