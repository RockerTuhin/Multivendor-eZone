@extends('layouts.front')
{{-- @section('content')
	<h2> Your Cart</h2>
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($cartItems as $cartItem)
			<tr>
				<td>{{ $cartItem->name }}</td>
				<td>{{ Cart::session(auth()->id())->get($cartItem->id)->getPriceSum() }}</td>
				<td>
					<form action="{{ route('cart.update',$cartItem->id) }}">
						<input type="number" value="{{ $cartItem->quantity }}" name="quantity">
						<input type="submit" value="save">
					</form>
				</td>
				<td><a href="{{ route('cart.destroy',$cartItem->id) }}">Delete</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<h3>Total Price: $ {{ $total = Cart::session(auth()->id())->getTotal() }}</h3>
	<a href="{{ route('cart.checkout') }}" class="btn btn-primary" role="button">Proceed to Checkout</a>
@endsection --}}

@section('content')

<livewire:mall-cart />

@endsection