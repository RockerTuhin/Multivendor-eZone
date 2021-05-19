<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaypalService;
use App\Order;
use App\Mail\OrderPaid;
use Illuminate\Support\Facades\Mail;

class PaypalLatestSDKController extends Controller
{
    private $paypalService;

    function __construct(PaypalService $paypalService)
    {
        $this->paypalService = $paypalService;
	}
	
    public function getExpressCheckout($order_id)
    {
		$response = $this->paypalService->createOrder($order_id);
		
		if($response->statusCode !== 201)
		{
			abort(500);
		}

		$order = Order::find($order_id);
		$order->paypal_order_id = $response->result->id;
		$order->save();

		foreach ($response->result->links as $link) {
			if ($link->rel == 'approve') {
				return redirect($link->href);
			}
		}
    }

    public function cancelPage()
    {
    	dd('payment failed');
    }

    public function getExpressCheckoutSuccess(Request $request, $order_id)
    {
		$order = Order::find($order_id);

		$response = $this->paypalService->captureOrder($order->paypal_order_id);

		if($response->result->status == 'COMPLETED')
		{
			$order->is_paid = 1;
			$order->save();

			//empty cart
			\Cart::session(auth()->id())->clear();

			Mail::to($order->user->email)->send(new OrderPaid($order));
			
			return redirect()->route('home')->withMessage('Payment Successful!');
		}
		
		return redirect()->route('home')->withMessage('Payment Unuccessful! Something went wrong!');
    }
}
