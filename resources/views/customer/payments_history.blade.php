@extends('customer.layouts.page_layout')

@section('content')
	<div class="container">
		
	<?php 

		$payments = DB::table('payments')->where('cust_id',Session::get('cust_logged_id'))->orderby('created_at',"DESC")->get()->toarray();

	?>


	@if(count($payments) > 0)
		
		<div style="min-height: 400px;">
			<h1 class="my-3 text-center">Your Online Payment Recornds</h1>
			<table class="table">
				<tr class="bg-info text-light">
					<th>Order Number</th>
					<th>Amount</th>
					<th>Status</th>
				</tr>
			@foreach($payments as $payment)
				
				<tr>
						
						<td>
							ORD {{ $payment->order_id }}
							<br>
							@if($payment->card_number != NULL)
								<b>| Last Digits {{ substr($payment->card_number, -4) }}</b>
							@endif
						</td>
						<td>
							@if(isset($_COOKIE['curr']))
								@if($_COOKIE['curr'] == "INR")
									Rs. <?= number_format($payment->amount,2) ?>
								@elseif($_COOKIE['curr'] == "USD")
									$ <?= number_format($payment->amount / 74,2) ?> 
								@endif
							@else
								Rs. <?= number_format($payment->amount,2) ?>
							@endif
						</td>
						<td>
							{{ $payment->status }}
						</td>


				</tr>
	
			@endforeach

		</table>
		</div><br><br>

	@else
		
		<div class="text-center my-5 py-3">
            <img src="{{ asset('img/support/no_orders.png') }}" class="img-fluid w-50" style="max-width: 400px;" alt="">
            <br>
            <h2 class="my-5">Your Don't have any online Payment Records</h2>
        </div>
		
	
	@endif
	</div>

@endsection