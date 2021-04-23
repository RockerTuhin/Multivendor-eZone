<?php

namespace App\Http\Livewire;

use App\CouponModel;
use App\Http\Livewire\MallCart;
use Livewire\Component;

class Coupon extends Component
{
	public $coupon_code = "";

	public function mount()
	{
		$this->coupon_code = "";
	}
	public function applyCoupon()
	{
		//$couponCode = request('coupon_code');

        $couponData = CouponModel::where('code',$this->coupon_code)->first();

        if(!$couponData)
        {
        	// \Cart::session(auth()->id())->clearCartConditions();
            return back()->withMessage('Sorry! Coupon does not exist');
        }
        else 
        {
        	$condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => $couponData->name,
                'type' => $couponData->type,
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => $couponData->value,
            ));

	        \Cart::session(auth()->id())->condition($condition); // for a speicifc user's cart

	        $this->emit('couponApply');
        }
	}

    public function render()
    {
        return view('livewire.coupon');
    }
}
