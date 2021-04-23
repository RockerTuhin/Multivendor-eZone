{{-- <div> --}}
    {{-- <a class="animate-top" title="Add To Cart" href="{{ route('cart.add', $product->id) }}">
        <i class="pe-7s-cart"></i>
    </a> --}}
    <a class="animate-top" title="Add To Cart" wire:click="addToCart({{ $product }})">
        <i class="pe-7s-cart"></i>
    </a>
    @if (session()->has('message'))
	    <div class="alert alert-success">
	        {{ session('message') }}
	    </div>
	@endif
{{-- </div> --}}
