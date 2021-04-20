<?php

namespace App\Http\Controllers;

use App\Coupon;
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

    public function applyCoupon()
    {
        $couponCode = request('coupon_code');

        $couponData = Coupon::where('code',$couponCode)->first();

        if(!$couponData)
        {
            return back()->withMessage('Sorry! Coupon does not exist');
        }
        $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => $couponData->name,
                'type' => $couponData->type,
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => $couponData->value,
            ));

        \Cart::session(auth()->id())->condition($condition); // for a speicifc user's cart

        return back()->withMessage('coupon applied');
    }

}
