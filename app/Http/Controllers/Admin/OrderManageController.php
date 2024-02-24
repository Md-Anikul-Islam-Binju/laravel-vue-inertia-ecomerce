<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    public function orderManage()
    {
        $orders = Order::with('user', 'items', 'shippingInfo')->get();
        dd($orders);

    }
}
