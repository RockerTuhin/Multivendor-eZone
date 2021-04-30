<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Order;
use App\SubOrder;
use App\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subOrders = SubOrder::where('seller_id',auth()->id())->get();
        
	    return view('sellers.orders.index', compact('subOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SubOrder $order)
    {
        $items = $order->items;

        return view('sellers.orders.show',compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function markDelivered(SubOrder $subOrder)
    {
        $subOrder['status'] = 'completed';

        $subOrder->save();

        $pendingSubOrders = $subOrder->order->subOrders()->where('status','!=','completed')->count();

        if($pendingSubOrders == 0)
        {
            $subOrder->order()->update(['status' => 'completed']);
        }

    	return redirect('admin/seller/orders')->withMessage('Order Marked Completed');
    }
}
