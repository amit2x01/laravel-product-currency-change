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
								<h6 class="bold mb-2">Modify Account Details</h6>
								@if(Session::has('update_msg'))
									<div class="alert alert-info m-2">
										{{ Session::get('update_msg') }}
									</div>
                                   @endif
							</div>
							<div class="p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<form action="{{ url('account/modify') }}" method="post">
									@csrf
									<div class="row">
										<div class="col-md-6">
											<p class="text-secondary bold mb-3">Login Information</p>
											<h6 class="mb-2">
												<b class="text-info">Email</b><br>
												<input type="text" name="modify_email" value="{{ $customerDetails['cust_email'] }}" class="form-control my-2" required> 

												@if($errors->has('modify_email'))
													<span class="text-danger text-16 bold">{{ $errors->first('modify_email') }}</span>
	                                        	@endif

											</h6>
											<h6 class="mb-2">
												<b class="text-info">Phone</b><br>
												<input type="text" name="modify_phone" value="{{ $customerDetails['cust_phone'] }}" class="form-control my-2" required> 

												@if($errors->has('modify_phone'))
													<span class="text-danger text-16 bold">{{ $errors->first('modify_phone') }}</span>
	                                        	@endif

											</h6>
										</div>
										<div class="col-md-6">
											<p class="text-secondary bold mb-3">Personal Information</p>
											<h6 class="mb-2">
												<b class="text-info">Name</b><br>
												<input type="text" name="modify_name" value="{{ $customerDetails['cust_name'] }}" class="form-control my-2" required> 
												
												@if($errors->has('modify_name'))
													<span class="text-danger text-16 bold">{{ $errors->first('modify_name') }}</span>
	                                        	@endif

											</h6>
											<h6 class="mb-2">
												<b class="text-info">Date of Birth</b><br>
												<input type="date" name="modify_dob" value="{{ $customerDetails['cust_dob'] }}" class="form-control my-2"> 
											</h6>
											<h6 class="mb-2">
												<b class="text-info">Gender</b><br>
												<select name="modify_gender" class="form-control my-2">
													@if($customerDetails['cust_gender'])
														<option value="{{ $customerDetails['cust_gender'] }}" selected hidden>{{ $customerDetails['cust_gender'] }}</option>
													@endif
														<option value="Male">Male</option>
														<option value="Female">Female</option>
														<option value="Others">Others</option>
												</select>
											</h6>
										</div>
									</div>
									<br>
									<button type="submit" class="btn btn-primary px-4 btn-sm">Update Now</button>
									<a href="{{ url('account') }}" class="btn btn-outline-danger btn-sm px-4">Cancel & Back</a>
								</form>
								
								
							</div>
						</div>
					</div>
				</div>
			<!-- !dashboard -->
@endsection