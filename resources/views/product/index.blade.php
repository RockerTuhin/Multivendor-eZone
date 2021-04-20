@extends('layouts.front')

@section('content')

	<div class="electro-product-wrapper wrapper-padding pt-45 pb-45">
		<div class="container-fluid">
			<h2>{{ $categoryName ?? null }} Products</h2>
			<div class="top-product-style">
				<div class="custom-row-2">
					@foreach($products as $product)
						@include('product._single_product')
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection