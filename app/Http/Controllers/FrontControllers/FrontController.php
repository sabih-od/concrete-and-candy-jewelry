<?php

namespace App\Http\Controllers\FrontControllers;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Services\Admin\CMSPagesService;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    /**
     * @var CMSPagesService
     */
    public $cmsPagesService;

    public function __construct(CMSPagesService $cmsPagesService)
    {
        $this->cmsPagesService = $cmsPagesService;

    }

    function index()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('home');

            return view('front.pages.index', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    function about()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('about');

            return view('front.pages.about', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    function contact()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('contact');

            return view('front.pages.contact', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    function categories()
    {
        try {
            return view('front.pages.earrings');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    function faq()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('faq');

            return view('front.pages.faq', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    function privacyPolicy()
    {
        try {
            return view('front.pages.privacy-policy');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    function termsAndCondition()
    {
        try {
            return view('front.pages.terms-and-conditions');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    function returnPolicy()
    {
        try {
            return view('front.pages.refund-policy');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    function shop()
    {
        try {
            $data['homeData'] = $this->cmsPagesService->getPageBySlug('shop');

            return view('front.pages.shop', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }
}
