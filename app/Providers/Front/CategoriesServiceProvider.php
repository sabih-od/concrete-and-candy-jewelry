<?php

namespace App\Providers\front;

use App\Services\Admin\CategoryService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CategoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Any service registration code can go here if needed.
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeHeader();
        $this->composeFooter();
    }

    /**
     * Compose the header view.
     *
     * @return void
     */
    private function composeHeader()
    {
        View::composer('front.layout.partials.menu', function ($view) {
            $categories = $this->getCategories();
            $view->with('categories', $categories);
        });
    }

    /**
     * Compose the footer view.
     *
     * @return void
     */
    private function composeFooter()
    {
        View::composer('front.layout.partials.footer', function ($view) {
            $categories = $this->getCategories();
            $view->with('categories', $categories);
        });
    }

    /**
     * Get all categories from the CategoryService.
     *
     * @return mixed
     */
    private function getCategories()
    {
        $categoryService = app(CategoryService::class);
        return $categoryService->getAllCategories();
    }
}
