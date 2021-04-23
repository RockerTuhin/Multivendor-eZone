<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartUpdateForm extends Component
{
	public $cartItem = [];
	public $quantity = 0;

	public function mount($cartItem)
	{
		$this->cartItem = $cartItem;
		$this->quantity = $cartItem['quantity'];
	}

	public function updateCart()
	{
		\Cart::session(auth()->id())->update($this->cartItem['id'], array(
    		'quantity' => array(
		      'relative' => false,
		      'value' => $this->quantity,
		  	),
		));

		$this->emit('updatedCart');
	}

    public function render()
    {
        return view('livewire.cart-update-form');
    }

}
