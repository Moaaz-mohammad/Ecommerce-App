<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::OrderBy('created_at', 'DESC')->get();
        $cart = session()->get('cart', []);
        return view('dashboard.orders.index', compact('orders','cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $details = $order->order_details;
        return view('dashboard.orders.details', compact('details', 'order',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $user = Auth::user();
        $message = 'This Order Has Done';
        $orderId = $order->id;
        $user->notify(new OrderNotification($message, $orderId));
        $order->delete();
        $categories = Category::all();
        $products = Product::all();
        $cart = session()->get('cart', []);
        return view('welcome', compact('categories', 'products', 'cart'));
    }
}
