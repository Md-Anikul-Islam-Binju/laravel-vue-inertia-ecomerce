<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function product()
    {
        return inertia('Frontend/Product/Product');
    }

    public function productDetails()
    {
        return inertia('Frontend/Product/ProductDetails');
    }
}
