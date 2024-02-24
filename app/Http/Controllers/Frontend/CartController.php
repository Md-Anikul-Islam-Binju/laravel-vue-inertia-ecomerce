<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $user = auth()->user();
        $categories = Category::where('status',1)->latest()->get();
        $cart = session()->get('cart');
        return inertia('Frontend/Shopping/Cart',compact('user','cart','categories'));
    }

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        $cart = session()->get('cart');

        if(!$cart){
            // If cart is empty, initialize it with the first product
            $cart = [
                $product->id => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->sale_price,
                    'image' => $product->image,
                ]
            ];
        } else {
            // If cart already contains products, check if the product is already in the cart
            if(isset($cart[$product->id])) {
                // If the product is already in the cart, increase its quantity
                $cart[$product->id]['quantity']++;
            } else {
                // If the product is not in the cart, add it to the cart
                $cart[$product->id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->sale_price,
                    'image' => $product->image,
                ];
            }
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);
        return redirect()->route('cart');
    }


    public function updateCartQuantity(Request $request, $product_id)
    {
        // Retrieve the quantity from the request
        $quantity = $request->input('quantity');
        session()->put("cart.$product_id.quantity", $quantity);
        return response()->json(['success' => true]);
    }

    public function removeToCart($product_id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$product_id])){
            unset($cart[$product_id]);
            session()->put('cart', $cart);
            return redirect()->route('cart');
        }
    }

    public function checkOut()
    {
        $user = auth()->user();
        $cart = session()->get('cart');
        $orderSubtotal = 0;
        foreach ($cart as $cartItem) {
            $cartItem['subtotal'] = $cartItem['price'] * $cartItem['quantity'];
            $orderSubtotal += $cartItem['subtotal'];
        }
        return inertia('Frontend/Shopping/Checkout',compact('user','cart','orderSubtotal'));
    }

    public function orderConfirm(Request $request)
    {

        $user = auth()->user();
        $order = session()->get('cart');
        $shippingCost = 100; // Adjusted shipping cost
        $orderSubtotal = 0; // Initialize orderSubtotal
        foreach ($order as $orderData) {
            $orderData['subtotal'] = $orderData['price'] * $orderData['quantity'];
            $orderSubtotal += $orderData['subtotal'];
        }
        // Create order
        $newOrder = new Order();
        $newOrder->user_id = $user->id;
        $newOrder->subtotal = $orderSubtotal;
        $newOrder->shipping_cost = $shippingCost;
        $newOrder->total = $orderSubtotal + $shippingCost;
        $newOrder->save();

        // Create order items
        foreach ($order as $orderData) {
            $item = new OrderItem();
            $item->order_id = $newOrder->id;
            $item->product_name = $orderData['name'];
            $item->quantity = $orderData['quantity'];
            $item->price = $orderData['price'];
            $item->save();
        }

        // Create shipping info
        if($request->payment_method == 'cod'){
            $shippingInfo = new ShippingInfo();
            $shippingInfo->order_id = $newOrder->id;
            $shippingInfo->name = $request->input('name');
            $shippingInfo->email = $request->input('email');
            $shippingInfo->mobile_no = $request->input('mobile_no');
            $shippingInfo->address = $request->input('address');
            $shippingInfo->payment_method = 'cod';
            $shippingInfo->save();
            // Clear cart
            session()->forget('cart');
            return redirect()->route('home'); //
        }else{

        }
    }


}
