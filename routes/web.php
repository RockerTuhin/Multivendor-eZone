<?php

use Illuminate\Support\Facades\Route;
use App\Order;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/ezonelaravel7/public/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon')->middleware('auth');


Route::resource('orders','OrderController')->middleware('auth');

Route::resource('shops','ShopController')->middleware('auth');

Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::resource('products','ProductController');


Route::get('paypal/checkout/{order_id}','PaypalController@getExpressCheckout')->name('paypal.checkout');

Route::get('paypal/checkout-success/{order_id}','PaypalController@getExpressCheckoutSuccess')->name('paypal.success');
Route::get('paypal/checkout-cancel','PaypalController@cancelPage')->name('paypal.cancel');


Route::group(['prefix' => 'admin'], function () {

    Voyager::routes();

    Route::group(['prefix' => 'seller','middleware' => 'auth','as' => 'seller.','namespace' =>'Seller'],function()
	{

		Route::resource('/orders','OrderController');

		Route::get('/order/delivered/{subOrder}','OrderController@markDelivered')->name('order.delivered');

	});

	Route::get('/order/pay/{subOrder}','SubOrderController@pay')->name('order.pay');
});


Route::get('/test',function(){
	$order = Order::find(2);
	//dd($order->items->groupBy('shop_id'));
	$order->generateSubOrders();
});