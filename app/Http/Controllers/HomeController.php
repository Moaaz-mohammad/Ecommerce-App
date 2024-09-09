<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Prompts\Prompt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = auth()->user();
        if ($user->hasRole('admin')) {
            $categories = Category::all();
            $products = Product::all();
            return view('dashboard.products.index', compact('categories', 'products'));
        }else {
            $categories = Category::all();
            $products = Product::all();
            return view('welcome', compact('categories', 'products'));
        }
    }
}
