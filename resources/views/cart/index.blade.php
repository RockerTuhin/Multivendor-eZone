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
<!-- shopping-cart-area start -->
<div class="cart-main-area pt-95 pb-100">
    <div class="container">
        {{-- Display success meassage --}}
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert" style="text-align: center;">
                {{ session('message') }}
            </div>
        @endif

        {{-- Display error meassage --}}
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert" style="text-align: center;">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="cart-heading">Cart</h1>
                {{-- <form action="#"> --}}
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>remove</th>
                                    <th>images</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@php 
                            		$allCartItem = $cartItems->sort(); 
                            	@endphp
                            	@foreach($allCartItem as $cartItem)
                                <tr>
                                    <td class="product-remove"><a href="{{ route('cart.destroy',$cartItem->id) }}"><i class="pe-7s-close"></i></a></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="assets/img/cart/1.jpg" alt=""></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{ $cartItem->name }} </a></td>
                                    <td class="product-price-cart"><span class="amount">${{ $cartItem->price }}</span></td>
                                    <td class="product-quantity">
                                        <form action="{{ route('cart.update',$cartItem->id) }}">
											<input type="number" value="{{ $cartItem->quantity }}" name="quantity">
											<input type="submit" value="save">
										</form>
                                    </td>
                                    <td class="product-subtotal">${{ Cart::session(auth()->id())->get($cartItem->id)->getPriceSum() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <form action="{{ route('cart.coupon') }}" method="GET">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text" required="">
    									<input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </form>
                                </div>
                                <div class="coupon2">
                                    <input class="button" name="update_cart" value="Update cart" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Subtotal<span>${{ Cart::session(auth()->id())->getSubTotal() }}</span></li>
                                    <li>Total<span>${{ $total = Cart::session(auth()->id())->getTotal() }}</span></li>
                                </ul>
                                <a href="{{ route('cart.checkout') }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
<!-- shopping-cart-area end -->
@endsection