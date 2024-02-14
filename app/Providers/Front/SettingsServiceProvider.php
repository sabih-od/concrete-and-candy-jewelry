<?php

namespace App\Providers\Front;

use App\Services\Admin\SettingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['front.*', 'dashboards.*', 'admin.*'], function ($view) {
            $settingService = app(SettingService::class);
            $settings = $settingService->getLatestSettings(1);
            $view->with('settings', $settings);
        });

    }

}
