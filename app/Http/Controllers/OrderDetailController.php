<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Order_Detail $order_Detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order_Detail $order_Detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order_Detail $order_Detail)
    {
        return 'hi';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order_Detail $order_Detail)
    {
        //
    }

    public function orderStatusUpdate(Request $request, $id) {
        $order = Order::find($id);
        // return $order;
        if ($order->order_status == 'prcessing') {
            $order->update([
                'order_status' => 'shipped',
            ]);
        }elseif ($order->order_status == 'shipped') {
            $order->update([
                'order_status' => 'delivered',
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated');
    }
    public function statusUpdate(Request $request, $id) {
        $order = Order::find($id);
        $order->update([
            'order_status' => $request->order_status,
        ]);

        // $order->save();
        return redirect()->back()->with('success', 'Status Updated');
    }
}
