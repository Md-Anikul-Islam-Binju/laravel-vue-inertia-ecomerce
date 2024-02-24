<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalBrand = Brand::count();
        $totalProduct = Product::count();
        $totalOrder = Order::count();
        return inertia('Admin/Dashboard',compact('totalUser','totalBrand','totalProduct','totalOrder'));
    }
}
