<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SAdminMiddleware;
use App\Http\Middleware\UserMiddleware;


Route::get('/', [HomeController::class, 'home'])->name('user.index');
Route::get('/detail/{slug}', [HomeController::class, 'detail'])->name('user.product');
Route::get('/category/{name}', [HomeController::class, 'findCategory'])->name('user.findcategory');
Route::get('/findproduct', [HomeController::class, 'findProduct'])->name('user.findProduct');
Route::get('/view', [UserController::class, 'view360'])->name('user.show');
Route::get('/cskh', function () {
    return view('user.an');
})->name('user.cskh');

Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/login', [UserController::class, 'postlogin'])->name('user.postlogin');
Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/register', [UserController::class, 'postregister']);
Route::get('/logon', [AdminController::class, 'logon'])->name('logon');
Route::post('/logon', [AdminController::class, 'postlogon'])->name('postlogon');
Route::get('/logoutadmin', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::prefix('user')->middleware(UserMiddleware::class)->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::get('/cart-delete/{id}', [CartController::class, 'deleteCart'])->name('cart.delete');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/placeorder', [CartController::class, 'postcheckout'] )->name('cart.checkoutview');
    Route::get('/checkoutvnpay', [CartController::class, 'checkoutvnpay'] )->name('cart.checkoutvnpay');

    Route::get('/shiping', [UserController::class, 'shiping'])->name('user.shiping');
    Route::get('/finishshiping/{order}', [UserController::class, 'finishshiping'])->name('user.finishshiping');
    Route::get('/shipingdetail/{order}', [UserController::class, 'detailshiping'])->name('user.detailshiping');
    Route::get('/shipingWait', [UserController::class, 'shipingWait'])->name('user.shipingWait');
    Route::get('/shipingship', [UserController::class, 'shipingship'])->name('user.shipingship');
    Route::get('/Delivered', [UserController::class, 'Delivered'])->name('user.Delivered');
    Route::get('/Received', [UserController::class, 'Received'])->name('user.Received');
    
});

Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/uploadimage', [AdminController::class, 'uploadimage'])->name('admin.uploadimages');
    Route::post('/uploadimage', [AdminController::class, 'postuploadimage'])->name('admin.postuploadimage');
    
    Route::resource('category', CategoryController::class);
    Route::get('/category-trash', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get('/category-trash/{id}', [CategoryController::class, 'restore_id'])->name('category.restore_id');
    Route::get('/category-foredelete/{id}', [CategoryController::class, 'foredelete'])->name('category.foredelete');
    
    Route::get('/customer', [AdminController::class, 'customer'])->name('admin.customer');
    Route::get('/order', [OrderController::class, 'getAllOrder'])->name('admin.order');
    Route::get('/orderconfirm', [OrderController::class, 'getAllOrdercomfirm'])->name('admin.ordercomfirm');
    Route::get('/order/{order}', [OrderController::class, 'confirmOrder'])->name('order.confirm');
    Route::get('/orderback/{id}', [OrderController::class, 'finishOrder'])->name('order.finishOrder');

    Route::get('/shipall', [OrderController::class, 'getAllOrdership'])->name('admin.ordership');
    Route::get('/shipconfim', [OrderController::class, 'getAllshipcomfirm'])->name('order.getAllshipcomfirm');
    Route::get('/shipoder/{order}', [OrderController::class, 'confirmOrdership'])->name('order.confirmship');
    Route::get('/ship/{id}', [OrderController::class, 'finishOrdership'])->name('order.finishOrdership');

    Route::resource('product', ProductController::class);
    Route::get('/product-trash', [ProductController::class, 'restore'])->name('product.restore');
    Route::get('/product-trash/{id}', [ProductController::class, 'restore_id'])->name('product.restore_id');
    Route::get('/product-foredelete/{id}', [ProductController::class, 'foredelete'])->name('product.foredelete');
});
Route::prefix('sadmin')->middleware(SAdminMiddleware::class)->group(function () {
    Route::get('/staff', [AdminController::class, 'staff'])->name('sadmin.staff');
    Route::get('/addstaff', [AdminController::class, 'addstaff'])->name('sadmin.addstaff');
    Route::post('/addstaff', [AdminController::class, 'postaddstaff'])->name('postsadmin.addstaff');

});
