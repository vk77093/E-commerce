<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductsController;
 Route::resource('product', ProductsController::class);
 Route::get('/viewproduct',[ProductsController::class,'viewProducts']);
 Route::post('/addtocart',[ProductsController::class,'addToCart'])->name('addtocart.store');
 Route::get('/cart',[ProductsController::class,'cartView'])->name('cart');
 Route::get('/cart/delete/{id}',[ProductsController::class,'cartDelete'])->name('cart.delete');
 Route::get('/cart/decrement/{id}/{qty}',[ProductsController::class,'cartDecrement'])->name('cart.decrement');
 Route::get('/cart/increment/{id}/{qty}',[ProductsController::class,'cartIncrement'])->name('cart.increment');
 Route::get('/cart/rapidadd/{id}',[ProductsController::class,'rapidAdd'])->name('rapidadd');
 Route::get('/checkout',[ProductsController::class,'checkOut'])->name('checkout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
