<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    public function orderList()
    {
        $orderList = Order::with('user')->latest()->get();
        return inertia('Admin/Order/List',compact('orderList'));
    }
    public function orderManage($id)
    {
        $order = Order::where('id',$id)->with('user', 'items', 'shippingInfo')->first();
        return inertia('Admin/Order/Manage',compact('order'));
    }
}
