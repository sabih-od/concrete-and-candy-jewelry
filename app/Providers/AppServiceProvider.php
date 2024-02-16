<?php

namespace App\Providers;

use App\Services\Admin\CategoryService;
use App\Services\Admin\CMSPagesService;
use App\Services\Admin\ProductSizeService;
use App\Services\Admin\SettingService;
use App\Services\Notification\NotificationService;
use App\Services\Order\OrderService;
use App\Services\Payment\Gateways\StripeCheckoutService;
use App\Services\Payment\PaymentService;
use App\Services\Product\ProductReviewService;
use App\Services\Product\ProductService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserService::class, function ($app) {
            return UserService::getInstance();
        });

        $this->app->singleton(OrderService::class, function ($app) {
            return OrderService::getInstance();
        });

        $this->app->singleton(CMSPagesService::class, function ($app) {
            return CMSPagesService::getInstance();
        });

        $this->app->singleton(SettingService::class, function ($app) {
            return SettingService::getInstance();
        });

        $this->app->singleton(NotificationService::class, function ($app) {
            return NotificationService::getInstance();
        });

        $this->app->singleton(CategoryService::class, function ($app) {
            return CategoryService::getInstance();
        });

        $this->app->singleton(ProductService::class, function ($app) {
            return ProductService::getInstance();
        });

        $this->app->singleton(ProductReviewService::class, function ($app) {
            return ProductReviewService::getInstance();
        });

        $this->app->singleton(ProductSizeService::class, function ($app) {
            return ProductSizeService::getInstance();
        });
        $this->app->singleton(PaymentService::class, function ($app) {
            return PaymentService::getInstance();
        });

        $this->app->singleton(StripeCheckoutService::class, function ($app) {
            return StripeCheckoutService::getInstance();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
