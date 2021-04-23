<div>

    {{-- <form action="{{ route('cart.update',$cartItem['id']) }}">
		<input type="number" value="{{ $cartItem['quantity'] }}" name="quantity">
		<input type="submit" value="save">
	</form> --}}

	{{-- <form wire:submit.prevent="updateCart">
		<input type="number" wire:model="quantity">
		<input type="submit" value="save">
	</form> --}}

	<input type="number" wire:model="quantity" wire:change="updateCart">
		

</div>
