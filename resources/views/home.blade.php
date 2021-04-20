@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Products</h2>
    <div class="row justify-content-center">
        @foreach($allProduct as $product)
        <div class="col-3">
            <div class="card">
                <img class="card-img-top" src="{{ asset('shoe.jpeg') }}">

                <div class="card-body">
                    <h4 class="card-title"> {{ $product->name }}</h4>
                    <p class="card-text">{{ $product->description }}</p>
                    <h3 class="card-text">$ {{ $product->price }}</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('cart.add', $product->id) }}" class="card-link">Add to Cart</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
