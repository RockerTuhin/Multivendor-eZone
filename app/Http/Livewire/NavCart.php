<?php

namespace App\Http\Livewire;

use Livewire\Component;
//const Noty = require('noty');
//import Noty from "noty";
//const Noty = require("noty");

class NavCart extends Component
{
	protected $listeners = ['loadNavCart' => 'onLoadNavCart'];

	public function onLoadNavCart()
	{
		$this->mount();
		
		$this->emit('alert', ['type' => 'success', 'message' => 'Succesfully added to cart.']);
	}

    public function render()
    {
        return view('livewire.nav-cart');
    }
}
