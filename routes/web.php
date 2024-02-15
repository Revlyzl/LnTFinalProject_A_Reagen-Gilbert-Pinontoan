<?php

use App\Http\Controllers\historyController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\cartController;
use App\Http\Controllers\userController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\userProductController;
use App\Http\Controllers\adminProductController;

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

//dashboard------------------------------------------------------------------------------------------------------------
Route::get('/', function () {
    return view('dashboard', [
        'title'=>'Dashboard',
        'page'=>'Dashboard'
    ]);
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'title'=> 'Dashboard',
        'page'=>'Dashboard'
    ]);
});
//------------------------------------------------------------------------------------------------------------------------


//User, Login, Register---------------------------------------------------------------------------------------------------
//login
Route::get('/login', [loginController::class,'login'])->name('login')->middleware('guest');
Route::POST('/login-auth', [loginController::class, 'authenticate']);
Route::POST('/logout', [loginController::class,'logout'])->middleware('auth');

//register
Route::get('/register', [registerController::class,'register'])->middleware('guest');
Route::POST('/register-store', [registerController::class,'store']);

//user
Route::get('/user', [userController::class,'indexUser'])->middleware('auth')->middleware('is_admin');
//------------------------------------------------------------------------------------------------------------------------







//Product---------------------------------------------------------------------------------------------------------------
//adminProduct
Route::get('/adminProduct', [adminProductController::class,'indexProduct'])->middleware('auth')->middleware('is_admin');

//userProduct
Route::get('/userProduct', [userProductController::class,'indexProduct'])->middleware('auth');

//createProduct
Route::get('/create-product', [adminProductController::class,'createProduct'])->middleware('is_admin');
Route::POST('/store-product', [adminProductController::class,'storeProduct'])->middleware('is_admin');

//deleteProduct
Route::DELETE('/delete-product/{product:id}', [adminProductController::class,'deleteProduct'])->middleware('is_admin');

//editProduct
Route::get('/edit-product/{product:id}', [adminProductController::class,'editProduct'])->middleware('is_admin');
Route::PATCH('/update-product/{product:id}', [adminProductController::class,'updateProduct'])->middleware('is_admin');

//createCategory
Route::get('/create-category', [categoryController::class, 'createCategory'])->middleware('is_admin');
Route::POST('/store-category', [categoryController::class, 'storeCategory'])->middleware('is_admin');
//------------------------------------------------------------------------------------------------------------------------

//history---------------------------------------------------------------------------------------------------------------------
// Route::get('/index-history', [historyController::class,'indexHistory'])->middleware('auth');

//----------------------------------------------------------------------------------------------------------------------------

//invoice---------------------------------------------------------------------------------------------------------------------
Route::get('/index-history', [invoiceController::class,'indexHistory'])->middleware('auth');
Route::get('/index-invoice/{invoice_header:id}', [invoiceController::class, 'indexInvoice'])->middleware('auth');
Route::get('/create-order/{product:id}', [invoiceController::class,'createOrder'])->middleware('auth');
Route::post('/store-order/{product:id}', [invoiceController::class,'storeOrder'])->middleware('auth');
// Route::get('/order-list/{invoice_header:id}', [invoiceController::class,'orderList']);
Route::get('/order-list', [invoiceController::class,'orderList'])->middleware('auth');
// Route::get('/check-out', [invoiceController::class,'checkOut']);
Route::DELETE('/delete-order/{invoiceDetail:id}', [invoiceController::class,'deleteOrder'])->middleware('auth');
Route::get('/purchase-confirmation', [invoiceController::class,'purchaseConfirmation'])->middleware('auth');
// Route::get('/update_address_postal', [invoiceController::class,'updateAddressandPostal'])->middleware('auth');;
//----------------------------------------------------------------------------------------------------------------------------

//about
Route::get('/about', function () {
    return view('about', [
        'title'=> 'About',
        'page'=> 'About'
    ]);
});



// //cart
// Route::get('/add-to-cart/{product:id}', [cartController::class,'indexCart']);
// Route::POST('/store-to-cart', [cartController::class,'storeCart']);
// Route::get('/index-list-cart', [cartController::class,'indexListCart']);

// // order
// Route::get('/add-order/{product:id}', [orderController::class,'indexOrder']);
// Route::POST('/store-order', [orderController::class,'storeOrder']);
