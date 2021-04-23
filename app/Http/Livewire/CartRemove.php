<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartRemove extends Component
{
	public $cartItem = [];

	public function mount($cartItem)
	{
		$this->cartItem = $cartItem;
	}

	public function cartRemove()
	{
		$cartItems = \Cart::session(auth()->id())->remove($this->cartItem['id']);
		$this->emit('removedCart');
	}

    public function render()
    {
        return view('livewire.cart-remove');
    }
}
