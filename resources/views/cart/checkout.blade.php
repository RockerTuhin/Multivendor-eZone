@extends('layouts.app')
@section('content')
	<h2> Checkout</h2>
	<h2> Delivery Information</h2>

	<form action="{{ route('orders.store') }}" method="post">
		@csrf

		<div class="form-group">
			<label for="name">Full Name</label>
			<input type="text" name="shipping_fullname" id="name" class="form-control">
		</div>

		<div class="form-group">
			<label for="state">State</label>
			<input type="text" name="shipping_state" id="state" class="form-control">
		</div>

		<div class="form-group">
			<label for="city">City</label>
			<input type="text" name="shipping_city" id="city" class="form-control">
		</div>

		<div class="form-group">
			<label for="zipcode">Zip Code</label>
			<input type="text" name="shipping_zipcode" id="zipcode" class="form-control">
		</div>

		<div class="form-group">
			<label for="address">Full Address</label>
			<input type="text" name="shipping_address" id="address" class="form-control">
		</div>

		<div class="form-group">
			<label for="phone">Mobile</label>
			<input type="text" name="shipping_phone" id="phone" class="form-control">
		</div>

		<h4>Payment Option</h4>

		<div class="form-check">
			<label for="cash_on_delivery" class="form-check-label">
				<input type="radio" class="form-check-input" name="payment_method" id="cash_on_delivery" value="cash_on_delivery">Cash on Delivery
			</label>
		</div>

		<div class="form-check">
			<label for="paypal" class="form-check-label">
				<input type="radio" class="form-check-input" name="payment_method" id="paypal" value="paypal">Paypal
			</label>
		</div>

		<button type="submit" class="btn btn-primary mt-3">Place Order</button>

	</form>
@endsection