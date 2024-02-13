<?php

use App\Http\Controllers\FrontControllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubscriptionController as AdminSubscriptionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductSizeController;

use App\Http\Controllers\Admin\VoucherController as AdminVoucherController;

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuthController as AdminLoginController;

use App\Http\Controllers\Admin\AdminWalletController;

use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Order\OrderDetailController;
use App\Http\Controllers\Admin\Order\OrderReturnController;
use App\Http\Controllers\Admin\CMSPagesController;

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

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/about-us', [FrontController::class, 'about'])->name('front.about');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/faq', [FrontController::class, 'faq'])->name('front.faq');
Route::get('/privacy-policy', [FrontController::class, 'privacyPolicy'])->name('front.privacy-policy');
Route::get('/terms-and-conditions', [FrontController::class, 'termsAndCondition'])->name('front.term-and-conditions');
Route::get('/return-policy', [FrontController::class, 'returnPolicy'])->name('front.return-policy');
Route::get('/categories', [FrontController::class, 'categories'])->name('front.category');
Route::get('/shop', [FrontController::class, 'shop'])->name('front.shop');


// Admin Routes
Route::prefix('admin')->group(function () {

    Route::get('/', [AdminLoginController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');

    Route::middleware('role:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/commission', [CommissionController::class, 'commission'])->name('admin.commission');
        Route::post('/commission/edit', [CommissionController::class, 'commissionEdit'])->name('admin.commissionEdit');

//      Admin User Crud
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/user/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/user/store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'show'])->name('admin.user.edit');
        Route::put('/users/{user}/update', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::post('/users/delete/{user}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
        Route::post('/users/activate/{user}', [AdminUserController::class, 'changeUserStatus'])->name('admin.user.active');
        Route::get('/get-states-by-country', [AdminUserController::class, 'getStatesByCountry'])->name('admin.country.states');

//      Admin Category Crud
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'show'])->name('admin.category.edit');
        Route::put('/categories/{category}/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::post('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
//        Route::post('/users/activate/{user}', [UserController::class, 'changeUserStatus'])->name('admin.user.active');

//      Admin Product Crud
        Route::get('/products', [ProductController::class, 'index'])->name('admin.prods.index');
        Route::get('/product/create', [ProductController::class, 'create'])->name('admin.prod.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('admin.prod.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'show'])->name('admin.prod.edit');
        Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('admin.prod.update');
        Route::post('/products/delete/{product}', [ProductController::class, 'destroy'])->name('admin.prod.destroy');
        Route::post('/products/activate/{product}', [ProductController::class, 'changeProductStatus'])->name('admin.prod.active');

//      Admin Subscription Crud
        Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('admin.subscriptions.index');
        Route::get('/subscription/create', [AdminSubscriptionController::class, 'create'])->name('admin.subscription.create');
        Route::post('/subscription/store', [AdminSubscriptionController::class, 'store'])->name('admin.subscription.store');
        Route::get('/subscriptions/{subscription}/edit', [AdminSubscriptionController::class, 'show'])->name('admin.subscription.edit');
        Route::put('/subscriptions/{subscription}/update', [AdminSubscriptionController::class, 'update'])->name('admin.subscription.update');
        Route::post('/subscriptions/delete/{subscription}', [AdminSubscriptionController::class, 'destroy'])->name('admin.subscription.destroy');

//      CMS Routes
        Route::get('cms/pages/{slug}/edit', [CMSPagesController::class, 'edit'])->name('admin.pages.edit');
        Route::post('cms/pages/{slug}/update', [CMSPagesController::class, 'editAndUpdate'])->name('admin.pages.update');
//      Admin Roles Crud
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/role/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/roles/{role}/edit', [RoleController::class, 'show'])->name('admin.role.edit');
        Route::put('/roles/{role}/update', [RoleController::class, 'update'])->name('admin.role.update');
        Route::post('/roles/delete/{role}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

        //      Admin sizes Crud
        Route::get('/sizes', [ProductSizeController::class, 'index'])->name('admin.sizes.index');
        Route::get('/size/create', [ProductSizeController::class, 'create'])->name('admin.size.create');
        Route::post('/size/store', [ProductSizeController::class, 'store'])->name('admin.size.store');
        Route::get('/sizes/{size}/edit', [ProductSizeController::class, 'show'])->name('admin.size.edit');
        Route::put('/sizes/{size}/update', [ProductSizeController::class, 'update'])->name('admin.size.update');
        Route::post('/sizes/delete/{size}', [ProductSizeController::class, 'destroy'])->name('admin.size.destroy');

        //   Wallets
        Route::get('wallets/', [AdminWalletController::class, 'index'])->name('my.wallets.index');

        //      Admin Settings Crud
        Route::get('/settings/edit/{setting}', [SettingController::class, 'show'])->name('admin.settings.edit');
        Route::put('/settings/{setting}/update', [SettingController::class, 'update'])->name('admin.setting.update');

//      Admin Voucher Crud
        Route::get('/vouchers', [AdminVoucherController::class, 'index'])->name('admin.voucher.index');
        Route::get('/voucher/create', [AdminVoucherController::class, 'create'])->name('admin.voucher.create');
        Route::post('/voucher/store', [AdminVoucherController::class, 'store'])->name('admin.voucher.store');
        Route::get('/voucher/{voucher}/edit', [AdminVoucherController::class, 'show'])->name('admin.voucher.edit');
        Route::put('/vouchers/{voucher}/update', [AdminVoucherController::class, 'update'])->name('admin.voucher.update');
        Route::post('/vouchers/delete/{voucher}', [AdminVoucherController::class, 'destroy'])->name('admin.voucher.destroy');

    });

    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/orders/{page?}/{tab?}', [OrderController::class, 'index'])->name('my.orders.index');
    Route::get('/detail/{order}/{page?}', [OrderDetailController::class, 'index'])->name('my.order.details');

    Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');

});
