<?php

use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\orderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


//Login
Route::get('/authentic/login', [LogController::class, 'show_login'])->name('login');
Route::post('/check_login', [LogController::class,'check_login']);
Route::get('/authentic/register',[LogController::class,'show_register'])->name('register');
Route::post('/check_register',[LogController::class,'check_register']);
Route::get('/authentic/forgetpw',[LogController::class,'show_forgetpw']);
Route::post('/edit_pass',[LogController::class,'edit_pass']);

//Admin
Route::middleware('auth')->group(function(){
    Route::prefix('admin') -> group(function(){
        Route::get('/',[ProductController::class,'show_main']);
        // Product
        Route::get('product/list', [ProductController::class,'list_product']);
        Route::get('product/create', [ProductController::class,'add_product']);
        Route::get('product/edit/{id}',[ProductController::class,'edit_product']);
        Route::get('admin_info',[ProductController::class,'show_admin_info']);
        Route::get('order/list', [orderController::class,'list_order']);
        Route::get('order/detail/{order_detail}', [orderController::class,'detail_order']);
    });
});
//Product
Route::post('/admin/product/add', [ProductController::class,'insert_product']);
Route::get('/admin/product/delete',[ProductController::class,'delete_product']);
Route::post('/admin/product/edit/{id}',[ProductController::class,'update_product']);
//Product_image
Route::post('/upload',[UploadController::class,'uploadImage']);


// client-login-register-forget
Route::get('/authentic/cli_login',[LogController::class,'show_cli_login']);
Route::post('/check_cli_login',[LogController::class,'check_cli_login']);
Route::get('/authentic/cli_register',[LogController::class,'show_cli_register']);
Route::post('/check_cli_register',[LogController::class,'check_cli_register']);
Route::get('/authentic/cli_forgetpw',[LogController::class,'show_cli_forgetpw']);
Route::post('/edit_cli_pass',[LogController::class,'edit_cli_pass']);

// ----------------------------------------------------
Route::get('/', [FrontendController::class,'index']);
Route::get('/client/list/food', [FrontendController::class,'index']);
Route::get('/client/list/condiment', [FrontendController::class,'condiment_index']);
Route::get('/client/list/drink', [FrontendController::class,'drink_index']);
Route::get('/client/list/electric', [FrontendController::class,'elect_index']);
Route::get('/client/list/frozen', [FrontendController::class,'frozen_index']);
Route::get('/client/list/fruit', [FrontendController::class,'vefr_index']);
Route::get('/client/list/house_care', [FrontendController::class,'houcare_index']);
Route::get('/client/list/person_care', [FrontendController::class,'percare_index']);
Route::get('/client/list/snack', [FrontendController::class,'snack_index']);
Route::get('/client/search_list', [FrontendController::class,'search_list_index'])->name('client.search');

Route::get('/client/cart', [FrontendController::class,'show_cart']);
Route::get('/client/product_detail/{id}', [FrontendController::class,'show_product']);
//cart
Route::post('/cart/add',[FrontendController::class,'add_cart']);
Route::get('/cart/delete/{id}',[FrontendController::class,'delete_cart']);
Route::post('/cart/update',[FrontendController::class,'update_cart']);
Route::post('/cart/send',[FrontendController::class,'send_cart']);
Route::get('/client/order_confirm', function(){
    return view('client.order_confirm');
});
Route::get('/client/order_success', function(){
    return view('client.order_success');
});
Route::get('/client/client_info',[FrontendController::class,'show_client_info']);