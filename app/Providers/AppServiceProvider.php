<?php

namespace App\Providers;

use App\Services\Admin\CMSPagesService;
use App\Services\Admin\SettingService;
use App\Services\Order\OrderService;
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
