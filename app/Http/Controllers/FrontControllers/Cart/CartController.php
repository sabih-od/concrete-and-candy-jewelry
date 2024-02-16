<?php

namespace App\Http\Controllers\FrontControllers\Cart;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\Admin\CMSPagesService;
use App\Services\Product\ProductService;
use App\Services\Admin\SettingService;
use App\Services\Cart\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Stripe\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * @var CMSPagesService
     */
    private $cmsPagesService;
    private $cartService;

    public function __construct(
        CartService $cartService,
        CMSPagesService $cmsPagesService
    )
    {
        $this->cmsPagesService = $cmsPagesService;
        $this->cartService = $cartService;
    }

    public function index()
    {
        try {
            $cartData = $this->cmsPagesService->getPageBySlug('cart');
            $cart = $this->cartService->getCartContent();
            return view('front.pages.cart.cart', compact('cartData', 'cart'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function store(Product $product, Request $request)
    {
        try {
            $this->cartService->createOrUpdate($product, $request->all());
            return back()->with('success', 'Product Added Successfully');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }

    }

    public function update($id, Request $request)
    {
        try {
            $this->cartService->updateCart($id, $request->quantity);
            return back()->with('success', 'Product Updated Successfully');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function destroy($rowId)
    {
        try {
            $this->cartService->removeCart($rowId);
            return back()->with('success', 'Product Deleted Successfully');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function clearCart()
    {
        try {
            Cart::destroy();
            return WebResponses::successRedirectBack("Cart Clear Successfully");
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


}
