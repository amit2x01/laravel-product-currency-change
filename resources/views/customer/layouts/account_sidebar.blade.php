
	<?php

		$customer_details = DB::table('customers')->where('cust_id',Session::get('cust_logged_id'))->get()->toarray();
		$customer_details = $customer_details[0];

	?>
	<div class=" p-4 mb-3 text-center" style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">


		<p class="text-22 bold">{{$customer_details->cust_name}}</p>
		<p class="text-14 bold text-secondary">{{$customer_details->cust_email}}</p>
		<p class="text-14 bold text-secondary">+91 {{$customer_details->cust_phone}}</p>
	</div>

	<div class=" p-4 mb-3 d-none d-md-block"style="box-shadow:  0 0 4px rgba(0,0,0,0.4577);">
		<div class="d-flex flex-wrap flex-row">
			<a href="{{ url('account') }}" class="light-btn border-o border-bottom btn-block text-left">Account</a>
			<a href="{{ url('account/address') }}" class="light-btn border-o border-bottom btn-block text-left">My Address</a>
			<a href="{{ url('/account/modify/password') }}"  class="light-btn border-o border-bottom btn-block text-left">Change Password</a>
			<a href="{{ url('account/logout') }}" class="light-btn border-o btn-block text-left">Logout</a>
		</div>
	</div>
