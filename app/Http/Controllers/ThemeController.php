<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index() {
        $categories = Category::all();
        $products = Product::all();
        return view('welcome', compact('categories', 'products'));
    }

    public function cart($id) {
        $product = Product::find($id);
        return view('cart', compact('product'));
    }

    public function checkout($id, $qty) {
        $product = Product::find($id);
        $addresses = auth()->user()->addresses;
        return view('checkout', compact('product', 'qty', 'addresses'));
    }

    public function placeOrder($id, $qty, Request $request) {
        $product = Product::find($id);

        $order =  auth()->user()->orders()->create([
            'address_id' => $request->address_id,
            'total_quantity' => $qty,
            'total' => $product->price * $qty,
        ]);

        $order->order_details()->create([
            'product_id' => $product->id,
            'quantity' => $qty,
        ]);

        $product->stock = $product->stock - $qty;

        $product->save();

        return view('order_success', compact('order'));
    }

    public function myOrders() {
        $orders = auth()->user()->orders;
        return view('my_orders.index', compact('orders'));
    }
    public function myOrder($id) {
        $order = Order::find($id);
        $orderDetails = $order->order_details;
        return view('my_orders.details', compact('order', 'orderDetails'));
    }
}