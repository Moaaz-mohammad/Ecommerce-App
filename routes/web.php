<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;
use Psy\Output\Theme;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Cart Routes
Route::get('cart/', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/update_plus/{id}', [CartController::class, 'update_plus'])->name('cart.update.plus');
Route::post('/cart/update_minus/{id}', [CartController::class, 'update_minus'])->name('cart.update.minus');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Cart Routes 

Route::get('/', [ThemeController::class, 'index'])->name('store');
Route::get('{id}/cart', [ThemeController::class, 'cart'])->name('cart');
Route::get('contact/', [ThemeController::class, 'contact'])->name('contact');
Route::get('/shop', [ThemeController::class, 'shop'])->name('shop');
Route::get('/product/details/{id}', [ThemeController::class, 'ProductDetails'])->name('product.details');

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::resource('addresses', AddressController::class);
    Route::get('{id}/{qty}/checkout', [ThemeController::class, 'checkout'])->name('checkout');
    Route::post('/{id}/{qty}/place/order', [ThemeController::class, "placeOrder"])->name('place.order');
    Route::get('/my/orders/', [ThemeController::class, 'myOrders'])->name('my.orders');
    Route::get('/my/order/{id}', [ThemeController::class, 'myOrder'])->name('my.order');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/setSettings', function() {
//     Role::create(['name' =>'admin']);
// });

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('categories', CategoryController::class);
    Route::put('category/{cat}/', [CategoryController::class, 'activeDisabled'])->name('category.status.update');
    Route::resource('products', ProductController::class);
    Route::post('delete/one/product/{image}' , [ProductController::class , 'destroyOneImage'])->name('delete.one.product')->middleware('auth');
    Route::get('orders/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('order/{order}/', [OrderController::class, 'show'])->name('orders.show');
});
