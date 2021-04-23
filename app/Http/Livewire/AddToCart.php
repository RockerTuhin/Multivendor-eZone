<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class AddToCart extends Component
{
	public $product;
	public $productId;

	public function mount($product)
	{
		$this->product = $product;
		//dd($this->product);
	}

	public function addToCart(Product $product)
	{
		// $this->productId = $productId;
		//  dd($this->productId);
		//dd($productId);
    	\Cart::session(auth()->id())->add(array(
		    'id' => $product->id,
		    'name' => $product->name,
		    'price' => $product->price,
		    'quantity' => 1,
		    'attributes' => array(),
		    'associatedModel' => $product
		));
		// return back()->withMessage('product added to cart');
		//return back()->withMessage('product added to cart');
		$this->emit('loadNavCart');
	
	}
    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
