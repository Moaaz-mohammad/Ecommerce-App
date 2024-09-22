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
            $categories = Category::where('category_status', 'active')->get();
            $categories_featured = Category::where('product_of_category_status', 'featured')->get();
            $categories_popular = Category::where('product_of_category_status', 'popular')->get();
            $categories_best_seeler = Category::where('product_of_category_status', 'best-seller')->get();
            $categories = Category::all();
            $products = Product::all();
            return view('welcome', compact('categories', 'products', 'categories_best_seeler', 'categories_popular', 'categories_featured'));
        }
    }
}
