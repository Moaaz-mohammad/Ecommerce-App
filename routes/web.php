<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/setSettings', function() {
//     Role::create(['name' =>'customer']);
// });

Route::middleware(['auth'])->group(function() {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    // Route::post('delete/one/product/{image}', ProductController::class, 'destroyOneimage')->name('delete.one.product');
    Route::post('delete/one/product/{image}' , [ProductController::class , 'destroyOneImage'])->name('delete.one.product')->middleware('auth');
});