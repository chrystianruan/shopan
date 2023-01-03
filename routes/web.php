<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login\AuthController;
use App\Http\Controllers\login\UserController;
use App\Http\Controllers\login\RegisterController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('/strong', function () {
    return view('/strong');
});

Route::get('/', [GeneralController::class, 'indexWelcomeViewAndDeleteProductsWhenTimeExpiredFromCart']);
Route::get('/category/{id}', [GeneralController::class, 'selectProductsByCategory']);
Route::get('/search', [GeneralController::class, 'searchProducts']);
Route::get('/product/{id}', [GeneralController::class, 'showProduct']);

Route::post('/logout', [UserController::class, 'logout']);
Route::post('/add/cart', [CartController::class, 'addProductToCart']);
Route::post('/add-product/cart', [CartController::class, 'addProductToCartFromShowProductView']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/add/cart', [CartController::class, 'addProductToCart']);
Route::post('/add/purchase', [PurchaseController::class, 'purchaseItemsAndDeleteItemsPurchasedFromCart']);
Route::get('/purchases', [PurchaseController::class, 'showPurchases']);
Route::put('/cart/{id}', [CartController::class, 'changeQuantityOfProduct']);
Route::delete('/cart/{id}', [CartController::class, 'removeProductFromCart']);
Route::get('/login', [GeneralController::class, 'indexLoginView']);
Route::get('/register', [GeneralController::class, 'indexRegisterView']);
Route::get('/invoice/{id}', [PurchaseController::class, 'showInvoice']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/new/category', [CategoryController::class, 'create']);
    Route::post('/admin/new/category', [CategoryController::class, 'store']);
    Route::get('/admin/new/product', [ProductController::class, 'create']);
    Route::post('/admin/new/product', [ProductController::class, 'store']);
    Route::get('/admin/filter/product', [ProductController::class, 'filterProducts']);
    Route::post('/admin/filter/product', [ProductController::class, 'filterProducts']);
    Route::get('/admin/edit/product/{id}', [ProductController::class, 'editProduct']);
    Route::put('/admin/edit/product/{id}', [ProductController::class, 'updateProduct']);
    Route::get('/admin/show/product/{id}', [ProductController::class, 'showProduct']);
    Route::post('/login', [AuthController::class, 'authenticate']);

});


