<?php

namespace App\Http\Controllers\FrontControllers;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Services\Admin\CategoryService;
use App\Services\Admin\CMSPagesService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    /**
     * @var CMSPagesService
     */
    public $cmsPagesService;
    /**
     * @var ProductService
     */

    public $productService;
    /**
     * @var CategoryService
     */
    public $categoryService;

    public function __construct(CMSPagesService $cmsPagesService, ProductService $productService, CategoryService $categoryService)
    {
        $this->cmsPagesService = $cmsPagesService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;

    }

    public function index()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('home');
            $data['categories'] = $this->categoryService->getAllCategoriesWithLimit(4, true, false);
            $data['fresh_design'] = $this->productService->getProducts(5, true);
            $data['new_arrivals'] = $this->productService->getProducts(6, false, true);
            $data['category_collection'] = $this->categoryService->getAllCategoriesWithLimit(4, false, true);
            $data['most_love'] = $this->productService->getMostPurchasedProducts(6);

            return view('front.pages.index', $data);

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function about()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('about');

            return view('front.pages.about', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function contact()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('contact');

            return view('front.pages.contact', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function categories()
    {
        try {
            return view('front.pages.earrings');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function faq()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('faq');

            return view('front.pages.faq', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function privacyPolicy()
    {
        try {
            return view('front.pages.privacy-policy');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function termsAndCondition()
    {
        try {
            return view('front.pages.terms-and-conditions');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function returnPolicy()
    {
        try {
            return view('front.pages.refund-policy');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function shop($categorySlug = null)
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('shop');
            $data['category'] = $this->categoryService->getCategoryBySlug($categorySlug);

            $data['products'] = $this->productService->getProductsWithPagination($categorySlug);
            return view('front.pages.shop', $data);
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function shopProductDetail($slug)
    {
        $data['homeData'] = $this->cmsPagesService->getPageBySlug('shop');

        $data['product'] = Product::where('slug', $slug)->first();

        return view('front.pages.product-detail', $data);
    }

    public function getSizeColors(Request $request)
    {

        $colors = ProductVariation::where('product_id', $request->product_id)->where('size_id', $request->variation_size)->get();

        return response()->json([
            "data" => $colors,
            'status' => 200,
        ]);

    }

}
