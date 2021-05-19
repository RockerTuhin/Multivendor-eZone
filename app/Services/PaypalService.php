<?php

namespace App\Services;

use App\Order;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PaypalService
{
    private $client;

    function __construct()
    {
        $environment = new SandboxEnvironment(env('PAYPAL_SANDBOX_CLIENT_ID'), env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder($order_id)
    {
        $request = new OrdersCreateRequest();
        $request->headers["prefer"] = "return=representation";

        //$request->body = $this->simpleCheckoutData($order_id);
        $request->body = $this->checkoutData($order_id);

        return $this->client->execute($request);
    }

    public function captureOrder($paypal_order_id)
    {
        $request = new OrdersCaptureRequest($paypal_order_id);
        return $this->client->execute($request);
    }

    public function simpleCheckoutData($order_id)
    {
        $order = Order::find($order_id);

        return  [
                    "intent" => "CAPTURE",
                    "purchase_units" => [[
                        "reference_id" => 'ezonelaravel7_'.uniqid(),
                        "amount" => [
                            "value" => $order->grand_total,
                            "currency_code" => "USD"
                        ]
                    ]],
                    "application_context" => [
                        "cancel_url" => route('paypal_latest_sdk.cancel'),
                        "return_url" => route('paypal_latest_sdk.success', $order_id)
                    ] 
                ];
    }

    private function checkoutData($orderId)
    {
        $order = Order::find($orderId);
        $orderItems = [];

        foreach($order->items as $item) {

            $orderItems[] = [
                'name' => $item->name,
                'description' => \Str::limit($item->description, 100),
                'quantity' => $item->pivot->quantity,
                'unit_amount' => [
                    'currency_code' => 'USD',
                    'value' => $item->price
                ],
                'tax' =>
                [
                    'currency_code' => 'USD',
                    'value' => '0',
                ],
                'category' => 'PHYSICAL_GOODS',

            ];

        }



        $checkoutData = [
            'intent' => 'CAPTURE',
            'application_context' =>
            [
                'return_url' => route('paypal_latest_sdk.success', $orderId),
                'cancel_url' => route('paypal_latest_sdk.cancel'),
                'brand_name' => 'WEBMALL',
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'shipping_preference' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW',
            ],
            'purchase_units' => [
                [
                    'reference_id' =>  uniqid(),
                    'description' => 'some order description for the order',
                    'custom_id' => 'CUST-HighFashions',
                    'soft_descriptor' => 'HighFashions',
                    'items' => $orderItems,
                    'shipping' =>
                    [
                        'method' => 'United States Postal Service',
                        'name' =>
                        [
                            'full_name' => $order->shipping_fullname,
                        ],
                        'address' =>
                        [
                            'address_line_1' => $order->shipping_address,
                            'address_line_2' => $order->shipping_city,
                            'admin_area_2' => $order->shipping_state,
                            'postal_code' => $order->shipping_zipcode,
                            'country_code' => 'US',
                        ],
                    ],
                    'amount' =>
                    [
                        'currency_code' => 'USD',
                        'value' => $order->grand_total,
                        'breakdown' =>
                        [
                            'item_total' =>
                            [
                                'currency_code' => 'USD',
                                'value' => $order->items->sum('price'),
                            ],
                            'shipping' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                            'handling' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                            'tax_total' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                            'shipping_discount' =>
                            [
                                'currency_code' => 'USD',
                                'value' => '0',
                            ],
                        ],
                    ],
                ]
            ],

        ];

        return $checkoutData;
    }
}