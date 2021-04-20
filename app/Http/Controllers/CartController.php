<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
    	//dd($productId);
    	\Cart::session(auth()->id())->add(array(
		    'id' => $product->id,
		    'name' => $product->name,
		    'price' => $product->price,
		    'quantity' => 1,
		    'attributes' => array(),
		    'associatedModel' => $product
		));
		return redirect()->route('cart.index');
    }

    public function index()
    {
    	$cartItems = \Cart::session(auth()->id())->getContent();
    	return view('cart.index',['cartItems' => $cartItems]);
    }

    public function destroy($itemId)
    {
    	$cartItems = \Cart::session(auth()->id())->remove($itemId);
    	return back();
    }

    public function update($itemId)
    {
    	\Cart::session(auth()->id())->update($itemId, array(
    		'quantity' => array(
		      'relative' => false,
		      'value' => request('quantity')
		  	),
		));
    	return back();
    }

    public function checkout()
    {
    	return view('cart.checkout');
    }

}
