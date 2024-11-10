<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/store';


    // protected function redirectTo() {
    //     $cart = session()->get('cart', []);
    //     $user = auth()->user();
    //     if ($user->hasRole('admin')) {
    //         $categories = Category::all();
    //         $products = Product::all();
    //         return view('dashboard.products.index', compact('categories', 'products', 'cart'));
    //     }else {
    //         $categories = Category::where('category_status', 'active')->get();
    //         $categories_featured = Category::where('product_of_category_status', 'featured')->get();
    //         $categories_popular = Category::where('product_of_category_status', 'popular')->get();
    //         $categories_best_seeler = Category::where('product_of_category_status', 'best-seller')->get();
    //         $categories = Category::all();
    //         $products = Product::all();
    //         return view('welcome', compact('categories', 'products', 'categories_best_seeler', 'categories_popular', 'categories_featured', 'cart'));
    //     }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
