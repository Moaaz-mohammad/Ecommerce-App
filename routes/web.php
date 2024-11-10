<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\KoponCodeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThemeController;
use App\Models\Category;
use App\Models\Order_Detail;
use App\Models\Product;
use Faker\Provider\ar_EG\Text;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
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

Route::get('/store', [ThemeController::class, 'index'])->name('store');
Route::get('{id}/cart', [ThemeController::class, 'cart'])->name('cart');
Route::get('contact/', [ThemeController::class, 'contact'])->name('contact');
Route::get('/shop', [ThemeController::class, 'shop'])->name('shop');
Route::get('/product/details/{id}', [ThemeController::class, 'ProductDetails'])->name('product.details');

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::resource('addresses', AddressController::class);
    Route::get('address/{id}/updating', [AddressController::class, 'upadteToFavorite'])->name('UpadteToFavorite');
    Route::get('checkout', [ThemeController::class, 'checkout'])->name('checkout');
    Route::get('/place/order/{id?}', [ThemeController::class, "placeOrder"])->name('place.order');
    Route::get('/my/orders/', [ThemeController::class, 'myOrders'])->name('my.orders');
    Route::get('/my/order/{id}', [ThemeController::class, 'myOrder'])->name('my.order');
    // Cart Routes
    Route::get('cart/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/update_plus/{id}', [CartController::class, 'update_plus'])->name('cart.update.plus');
    Route::post('/cart/update_minus/{id}', [CartController::class, 'update_minus'])->name('cart.update.minus');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/kopon/check', [KoponCodeController::class, 'checkKopon'])->name('check.kopon');
    // Cart Routes 
});

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Route::get('/email/verify', [VerificationController::class, 'index'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $categories = Category::where('category_status', 'active')->get();
    $products = Product::where('product_show_status', 'active')->where('stock', '>', '0')->get();
    $cart = session()->get('cart', []);
    return redirect()->route('store', compact('categories', 'products','cart'));

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/email/verification-notification', function() {
    
    if (Auth::user()->hasVerifiedEmail()) {
        return redirect()->route('store')->with('status', 'Your email is already verified.');
    }

    Auth::user()->sendEmailVerificationNotification();

    return back()->with('status', 'Verification link has been resent!');
})
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');


Route::get('/', function () {
    
})->middleware(['auth', 'verified']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/setSettings', function() {
//     Role::create(['name' =>'admin']);
// });


Route::resource('kopon/code', KoponCodeController::class);


Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('notification', [NotificationController::class, 'index'])->name('notification');
    Route::resource('categories', CategoryController::class);
    Route::put('category/{cat}/', [CategoryController::class, 'activeDisabled'])->name('category.status.update');
    Route::resource('products', ProductController::class);
    Route::post('delete/one/product/{image}' , [ProductController::class , 'destroyOneImage'])->name('delete.one.product')->middleware('auth');
    Route::get('orders/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('order/{order}/', [OrderController::class, 'show'])->name('orders.show');
    Route::resource('order/detail', OrderDetailController::class);
    Route::put('order/status/update/{id}', [OrderDetailController::class, 'orderStatusUpdate'])->name('detail.status.update');
    Route::put('order/update/status/{id}', [OrderDetailController::class, 'statusUpdate'])->name('status.update');
    Route::get('customers/index', [DashboardControler::class, 'customersIndex'])->name('customers.index');

    // Route::get('kopon/codes/', [KoponCodeController::class, 'index'])->name('koponCodes');
    // Route::get('Genrate/code', [KoponCodeController::class, 'create'])->name('GenrateCode');
});
Route::resource('order', OrderController::class);

// Test The AJAX And JSON.
Route::post('send-notification', [NotificationController::class, 'sendNotification'])->name('sendNotificatoin');
Route::post('read-notification', [NotificationController::class, 'readmessage'])->name('readMessage');
Route::post('/add/cart', [CartController::class, 'addToCart'])->name('addToCart');
