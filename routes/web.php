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

Route::get('/', [ThemeController::class, 'index'])->name('store');
Route::get('{id}/cart', [ThemeController::class, 'cart'])->name('cart');

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
//     Role::create(['name' =>'customer']);
// });

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::post('delete/one/product/{image}' , [ProductController::class , 'destroyOneImage'])->name('delete.one.product')->middleware('auth');
    Route::get('orders/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('order/{order}/', [OrderController::class, 'show'])->name('orders.show');
});
