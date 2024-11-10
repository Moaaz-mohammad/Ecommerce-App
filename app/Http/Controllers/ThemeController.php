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
        $cart = session()->get('cart', []);
        return view('welcome', compact('categories', 'products', 'categories_best_seeler', 'categories_popular', 'categories_featured', 'cart'));
    }

    public function shop() {
        // $products = Product::all();
        $products = Product::Paginate(2);
        $categories = Category::all();
        $cart = session()->get('cart', []);
        return view('shop', compact('products', 'categories', 'cart'));
    }

    public function cart($id) {
        $product = Product::find($id);
        return view('cart', compact('product'));
    }

    public function checkout() {
        // $product = Product::find($id);
        $addresses = auth()->user()->addresses;
        $cart = session()->get('cart', []);
        $imagesPath = [];
        foreach ($cart as $item) {
            array_push($imagesPath, $item['image']);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['descount_price'] == 0 ? $item['price'] * $item['quantity'] : $item['descount_price'] * $item['quantity'];
        }
        return view('checkout', compact('cart','addresses', 'imagesPath', 'total'));
    }

    public function placeOrder(Request $request, $id = null) {

        $ids = explode(',', $id);

        $product = Product::find($id);
        $session = session()->get('cart', []);

        // foreach($session as $item) {
        //     foreach ($ids as $key) {
        //         $order =  auth()->user()->orders()->create([
        //             // 'address_id' => $request->address_id,
        //             'address_id' => $session[$key]['address_id'],
        //             'total_quantity' => $session[$key]['quantity'],
        //             'total' => $session[$key]['quantity'] * $session[$key]['price'],
        //             'order_status' => 'prcessing',
        //             'note' => 'dabl, ometimes by accident, sometimes on purpose (injected humour and the like)',
        //             'selling_price' => $session[$key]['descount_price'] != 0 ? $session[$key]['descount_price'] : $session[$key]['price'],
        //         ]);
        //     }
        // }
        // foreach($session as $key=> $value) {
        //     $order =  auth()->user()->orders()->create([
        //         'address_id' => $session[$key]['address_id'],
        //         'total_quantity' => $session[$key]['quantity'],
        //         'total' => $session[$key]['quantity'] * $session[$key]['price'],
        //         'order_status' => 'prcessing',
        //         'note' => 'dabl, ometimes by accident, sometimes on purpose (injected humour and the like)',
        //         'selling_price' => $session[$key]['descount_price'] != 0 ? $session[$key]['descount_price'] : $session[$key]['price'],
        //     ]);
        // }

            $totalQty = 0;
            foreach($session as $key=>$item) {
                $totalQty += $session[$key]['quantity'];
            }

            $total = 0;
            foreach($session as $key => $item) {
                $total += $session[$key]['price'] * $session[$key]['quantity'];
            }
            
            // return $totalQty;
            $order =  auth()->user()->orders()->create([
                'address_id' => auth()->user()->addresses()->first()->id,
                'total_quantity' => $totalQty,
                'total' => $total,
                'order_status' => 'prcessing',
                'note' => 'dabl, ometimes by accident, sometimes on purpose (injected humour and the like)',
                'selling_price' => 0,
            ]);

        session()->forget('cart');

    
        // Iam Here ---------------------------=>

        foreach ($session as $key => $value) {
            $order->order_details()->create([
                'order_id' => $order->id,
                'product_id' => $session[$key]['id'],
                'quantity' => $session[$key]['quantity'],
                'order_status' => $order->order_status,
            ]);
        }

        // $product->stock = $product->stock - $qty;

        // $product->save();
        $cart = session()->get('cart', []);
        return view('order_success', compact('cart'));
    }

    public function myOrders() {
        $orders = auth()->user()->orders;
        $cart = session()->get('cart', []);
        return view('my_orders.index', compact('orders','cart'));
    }
    public function myOrder($id) {
        // $order = Order::where('id', $id)->get();
        $order = Order::find($id);
        $orderDetails = $order->order_details;
        $cart = session()->get('cart', []);
        return view('my_orders.details', compact('order', 'orderDetails', 'cart'));
    }

    public function ProductDetails($id) {
        $categories = Category::where('category_status', 'active')->get();
        $cart = session()->get('cart', []);
        $product = Product::find($id);
        $products = Product::all();
        return view('product_details', compact('product', 'products', 'categories', 'cart'));
    }

    public function contact() {
        return view('contact');
    }
}