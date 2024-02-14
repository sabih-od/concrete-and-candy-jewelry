<?php

namespace App\Providers\Front;

use App\Services\Admin\CMSPagesService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FooterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    /*public function boot()
    {
        View::composer(['front.*'], function ($view) {
            $cmsService = app(CMSPagesService::class);
            $footer = $cmsService->getPageBySlug('footer');
            $view->with('footer', $footer);

        });
    }*/

    public function boot()
    {
        View::composer(['front.*'], function ($view) {
            $cmsSetting = app(CMSPagesService::class);
            $footer = $cmsSetting->getPageBySlug('footer');
            $view->with('footer', $footer);

        });
    }


}
