<?php

namespace App\Http\Controllers;

use App\Mail\OrderPaid;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
	private function checkoutData($order_id)
	{
		$cart = \Cart::session(auth()->id());
    	
		$cartItems = array_map(function($item){
			return [
				'name' => $item['name'],
				'price' => $item['price'],
				'qty' => $item['quantity'],
			];
		}, $cart->getContent()->toarray());

    	$checkoutData = [
    		'items' => $cartItems,

    		'return_url' => route('paypal.success', $order_id),
    		'cancel_url' => route('paypal.cancel'),
    		'invoice_id' => uniqid(),
    		'invoice_description' => " Order description ",
    		'total' => $cart->getTotal(),
    	];

    	return $checkoutData;
	}
    public function getExpressCheckout($order_id)
    {
    	
    	$checkoutData = $this->checkoutData($order_id);

    	$provider = new ExpressCheckout();

    	$response = $provider->setExpressCheckout($checkoutData);
    	$response = $provider->setExpressCheckout($checkoutData, true);

    	return redirect($response['paypal_link']);
    }

    public function cancelPage()
    {
    	dd('payment failed');
    }

    public function getExpressCheckoutSuccess(Request $request, $order_id)
    {
    	$token = $request->get('token');
    	$payerId = $request->get('PayerID');

    	$checkoutData = $this->checkoutData($order_id);

    	$provider = new ExpressCheckout();

    	$response = $provider->getExpressCheckoutDetails($token);


    	if(in_array(strtoupper($response['ACK']), ['SUCCESS','SUCCESSWITHWARNING']))
    	{
    		//PERFORM TRANSACTION ON PAYPAL
    		$payment_status = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);
    		$status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

    		if(in_array($status, ['Completed','Processed']))
    		{
    			$order = Order::find($order_id);
    			$order->is_paid = 1;
    			$order->save();

    			//send mail
                //dd($order);
                Mail::to($order->user->email)->send(new OrderPaid($order));

    			return redirect()->route('home')->withMessage('Payment Successful!');
    		}
    	}

    	return redirect()->route('home')->withError('Payment Unsuccessful! Something went wrong!');
    }
}
