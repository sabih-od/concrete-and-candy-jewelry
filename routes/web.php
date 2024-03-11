<?php

use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\FrontControllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductSizeController;

use App\Http\Controllers\Notification\NotificationController;

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AuthController as AdminLoginController;

use App\Http\Controllers\Admin\AdminWalletController;

use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Order\OrderDetailController;
use App\Http\Controllers\Admin\Order\OrderReturnController;
use App\Http\Controllers\Admin\CMSPagesController;

use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController as UserForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController as UserResetPasswordController;

use App\Http\Controllers\DashboardBaseController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\WishlistController;

use App\Http\Controllers\Payment\PaymentController;

use App\Http\Controllers\Product\ProductController;

use App\Http\Controllers\FrontControllers\Cart\CartController;
use App\Http\Controllers\FrontControllers\Checkout\CheckoutController;
use App\Http\Controllers\Payment\FrontPaymentController;


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
Route::get('/shop/{category?}', [FrontController::class, 'shop'])->name('front.shop');
Route::get('/product/detail/{slug?}', [FrontController::class, 'shopProductDetail'])->name('front.shop.product');
Route::post('/product/size/colors', [FrontController::class, 'getSizeColors'])->name('product.size.colors');

//Front Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('front.cart');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('front.cart.add');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('front.cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'destroy'])->name('front.cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('clear.cart');

//Checkout Routes
Route::get('/cart/checkout', [CheckoutController::class, 'index'])->name('front.checkout.form');
Route::post('/payment', [FrontPaymentController::class, 'index'])->name('front.payment.form');
Route::get('/success', [CheckoutController::class, 'success'])->name('front.success');

//Stripe Payment With Checkout
Route::post('/checkout', [FrontPaymentController::class, 'stripeCheckout'])->name('front.stripe.payment');

Route::post('/search', [FrontPaymentController::class, 'search'])->name('front.search');

//Auth Routes
Route::middleware(['guest'])->group(function () {

    // Login Routes
    Route::get('/login', [UserLoginController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [UserLoginController::class, 'login'])->name('user.login');

    // Registration Routes
    Route::get('/register', [UserRegisterController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [UserRegisterController::class, 'register'])->name('user.register');

    // Password Reset Routes
    Route::get('/forget/password/', [UserForgotPasswordController::class, 'forgetPasswordForm'])->name('forget.password.form');
    Route::post('/password/email', [UserForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset', [UserResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [UserResetPasswordController::class, 'reset'])->name('password.reset.submit');

});


// Admin Routes
Route::prefix('admin')->group(function () {

    Route::get('/', [AdminLoginController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');

    Route::middleware('role:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

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

        //      Admin sizes Crud
        Route::get('/sizes', [ProductSizeController::class, 'index'])->name('admin.sizes.index');
        Route::get('/size/create', [ProductSizeController::class, 'create'])->name('admin.size.create');
        Route::post('/size/store', [ProductSizeController::class, 'store'])->name('admin.size.store');
        Route::get('/sizes/{size}/edit', [ProductSizeController::class, 'show'])->name('admin.size.edit');
        Route::put('/sizes/{size}/update', [ProductSizeController::class, 'update'])->name('admin.size.update');
        Route::post('/sizes/delete/{size}', [ProductSizeController::class, 'destroy'])->name('admin.size.destroy');

//      CMS Routes
        Route::get('cms/pages/{slug}/edit', [CMSPagesController::class, 'edit'])->name('admin.pages.edit');
        Route::post('cms/pages/{slug}/update', [CMSPagesController::class, 'editAndUpdate'])->name('admin.pages.update');


        //   Wallets
        Route::get('wallets/', [AdminWalletController::class, 'index'])->name('my.wallets.index');

        //      Admin Settings Crud
        Route::get('/settings/edit/{setting}', [SettingController::class, 'show'])->name('admin.settings.edit');
        Route::put('/settings/{setting}/update', [SettingController::class, 'update'])->name('admin.setting.update');

    });

    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

});


Route::middleware(['auth'])->group(function () {


    Route::prefix('user')->middleware('role:user|vendor')->group(function () {

        // User Dashboard become-a-vendor
        Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/become/vendor', [UserDashboardController::class, 'userBecomeVendor'])->name('user.become.vendor');
        Route::get('/payments/history', [UserDashboardController::class, 'userPaymentHistory'])->name('user.payments.history');
        Route::get('/get-states-by-country', [ProfileController::class, 'getStatesByCountry'])->name('user.country.states');

        Route::post('/return/order/item/{order_id?}', [OrderReturnController::class, 'store'])->name('return.order.item');

        // USE FOR ONLY SET FLOW
        Route::get('/stripe-cancel/{type?}', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
    });

    // User Wishlist
    Route::get('/wishlists', [WishlistController::class, 'wishlists'])->name('user-wishlists');
    Route::get('/wishlist/add/{id}', [WishlistController::class, 'addwish'])->name('add-to-wishlist');
    Route::get('/wishlist/remove/{id}', [WishlistController::class, 'removewish'])->name('user-wishlist-remove');

    //  Orders route for admin, users and vendor product orders
    Route::get('/orders/{page?}/{tab?}', [OrderController::class, 'index'])->name('my.orders.index');
    Route::get('/detail/{order}/{page?}', [OrderDetailController::class, 'index'])->name('my.order.details');

    Route::get('/profile/{user}/edit', [ProfileController::class, 'show'])->name('user.vendor.profile.edit');
    Route::put('/profile/{user}/update', [ProfileController::class, 'update'])->name('user.vendor.profile.update');

    Route::get('/get-states/{countryId}', [ProfileController::class, 'getStates'])->name('user.get.states');

    // Edit Password
    Route::post('/password/update', [UserResetPasswordController::class, 'update'])->name('password.update');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/notifications/{notification?}', [NotificationController::class, 'destroy'])->name('notification.delete');

    // Download Invoice Pdf
    Route::get('/download/{invoice}/pdf/{page?}', [OrderController::class, 'generatePDF'])->name('order.pdf');

    Route::get('order/success', [DashboardBaseController ::class, 'orderSuccess'])->name('front.orderSuccess');
    Route::get('order/error', [DashboardBaseController::class, 'orderError'])->name('front.orderError');

    Route::get('/subscriptions', [DashboardBaseController::class, 'subscriptions'])->name('subscriptions');
    Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');

});
