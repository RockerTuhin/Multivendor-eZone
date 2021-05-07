<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubOrder;

class SubOrderController extends Controller
{
    public function pay(SubOrder $subOrder)
    {
        $subOrder->transactions()->create([
            'transaction_id' => uniqid($subOrder->id.'trans-'),
            'amount_paid' => $subOrder->grand_total-(0.05*$subOrder->grand_total),
            'commission' => 0.05*$subOrder->grand_total,
        ]);

        return redirect()->to('admin/transactions')->withMessage('Transaction Created');
    }
}
