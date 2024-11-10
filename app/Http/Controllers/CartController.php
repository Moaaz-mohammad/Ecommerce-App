<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total +=  $item['descount_price'] != 0 ? $item['descount_price'] * $item['quantity'] : $item['price'] * $item['quantity'];
        }
        // return $total;
        return view('cart_index', compact('cart', 'total'));
    }

    public function add($id) {
        
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $cart = session()->get('cart', []);
        $cartdetails = session()->get('cartdetails', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price ,
                'descount_price' => $product->descount_price,
                'quantity' => 1,
                'address_id' => auth()->user()->addresses()->first()->id,
                'image' => $product->images->first->path,
            ];
        }

        session()->put('cart', $cart);

        // return $cart;
        return redirect()->back()->with('success', 'Product added to cart');

    }

    public function update_plus($id) {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back();
        }
        return redirect()->back()->with('success', 'ProductNot Found');
    }
    
    public function update_minus($id) {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']--;
            if ($cart[$id]['quantity'] == 0) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->put('cart', $cart);
            return redirect()->back();
        }
        return redirect()->back()->with('success', 'ProductNot Found');
    }

    public function remove($id) {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product removed from cart');
        }else {
            return redirect()->back()->with('error', 'Product not found in cart');
        }
    }

    public function addToCart(Request $request) {
        $productID = $request->productId;

        $product = Product::find($productID);

        $cart =  session()->get('cart', []);

        if (isset($cart[$productID])) {
            $cart[$productID]['quantity']++;
        }else {
            $cart[$productID] = [
                'id' => $productID,
                'name' => $product->name,
                'price' => $product->price,
                'descount_price' => $product->descount_price,
                'quantity' => 1,
                'address_id' => Auth::user()->addresses->first()->id,
                'image' => $product->images->first->path,
            ];
        }

        // Updating the session
        session()->put('cart', $cart);

        return response()->json([
        'message' => 'hi' . $product->name,
        'length' => count($cart),
    ]);
    }
    
    // public function sendData(Request $request)
    // {
    //     $name = $request->input('name');
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Hello, ' . $name
    //     ]);
    // }

}