<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        return view('cart_index', compact('cart'));
    }

    public function add($id) {
        
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            // unset($cart[$id]);
        }else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'descount_price' => $product->descount_price,
                'quantity' => 1,
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
}