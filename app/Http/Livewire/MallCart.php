<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Coupon;
use Livewire\Component;

class MallCart extends Component
{
	public $cartItems = [];

	public $dataOfText = 'this is default one yahoo!';

	protected $listeners = ['updatedCart' => 'onUpdateCart','removedCart' => 'onRemoveCart','couponApply' => 'onApplyCoupon'];

	public function mount()
	{
		$this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
	}

	public function onUpdateCart()
	{
		$this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
		//$this->mount();
	}

	public function onRemoveCart()
	{
		$this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
		//$this->mount();
		$this->emit('alert', ['type' => 'success', 'message' => 'Item removed from cart!']);
	}

	public function onApplyCoupon()
	{
		$this->cartItems = \Cart::session(auth()->id())->getContent()->toArray();
		//$this->mount();
		$this->emit('alert', ['type' => 'success', 'message' => 'Coupon applied!']);
	}

    public function render()
    {
        return view('livewire.mall-cart');
    }

}
