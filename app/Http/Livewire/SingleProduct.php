<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SingleProduct extends Component
{
	public $product;

	public function mount($product)
	{
		$this->product = $product;
	}

    public function render()
    {
        return view('livewire.single-product');
    }
}
