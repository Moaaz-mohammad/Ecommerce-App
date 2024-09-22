<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Prompt;

class ThemeController extends Controller
{
    public function index() {
        // $categories = Category::where('category_status', 'active')->get();
        
        $categories = Category::where('category_status', 'active')->get();
        $categories_featured = Category::where('product_of_category_status', 'featured')->get();
        $categories_popular = Category::where('product_of_category_status', 'popular')->get();
        $categories_best_seeler = Category::where('product_of_category_status', 'best-seller')->get();
        $products = Product::where('product_show_status', 'active')->where('stock', '>', '0')->get();

        return view('welcome', compact('categories', 'products', 'categories_best_seeler', 'categories_popular', 'categories_featured'));
    }

    public function shop() {
        // $products = Product::all();
        $products = Product::Paginate(2);
        $categories = Category::all();
        return view('shop', compact('products', 'categories'));
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

    public function ProductDetails($id) {
        $categories = Category::where('category_status', 'active')->get();
        $product = Product::find($id);
        $products = Product::all();
        return view('product_details', compact('product', 'products', 'categories'));
    }

    public function contact() {
        return view('contact');
    }
}