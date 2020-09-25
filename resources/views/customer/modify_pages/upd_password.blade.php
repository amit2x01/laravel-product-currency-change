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
								<h6 class="bold mb-2">Modify Password</h6>
								
								@if(Session::has('update_msg'))
									<div class="alert alert-info m-2">
										{{ Session::get('update_msg') }}
									</div>
                                   @endif
							</div>
							<div class=" p-4 mb-3" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
								<form action="{{ url('account/modify/password') }}" method="post">
									<label>Enter New Password</label>
									<input type="password" name="password" value="{{ old('password') }}" class="form-control">

									 @if($errors->has('password'))
										<span class="text-danger text-16 bold">{{ $errors->first('password') }}</span>
                                    @endif

									<label>Re-type New Password</label>
									<input type="password" name="repassword" value="{{ old('repassword') }}" class="form-control">

									 @if($errors->has('repassword'))
										<span class="text-danger text-16 bold">{{ $errors->first('repassword') }}</span>
                                    @endif
									<br><br>
									<button type="submit" class="px-3 btn btn-warning">Update Password</button>
									<a href="{{ url('account') }}" class="btn btn-danger px-3">Cancel & Back</a>
									@csrf
									
								</form>
								
								
							</div>
						</div>
					</div>
				</div>
			<!-- !dashboard -->
@endsection