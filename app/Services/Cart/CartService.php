<?php

namespace App\Services\Cart;

use App\Helpers\WebResponses;
use App\Services\Admin\CMSPagesService;
use App\Services\Product\ProductService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{
    public function __construct(
        ProductService $productService
    )
    {
        $this->productService = $productService;
    }


    public function getCartContent()
    {
        return Cart::content();
    }

    public function createOrUpdate($product, $request)
    {
        $uniqueId = $this->getUniqueId($product, $request);
        // Check if the item already exists in the cart
        $existingItem = $this->checkUniqueIdOnCart($uniqueId);
        $this->updateOrAddToCart($existingItem, $product, $request, $uniqueId);
    }

    public function updateCart($id, $quantity)
    {
        try {
            $cart = Cart::get($id);
            $productStock = $cart->options['product']->stock_quantity;
            if ($quantity > $productStock) {
                throw new \Exception('Sorry! Insufficient stock available.');
            }
            Cart::update($id, $quantity); // Will update the quantity
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function removeCart($rowId)
    {
        Cart::remove($rowId);
    }

    public function removeWholeCart()
    {
        Cart::destroy();
        session()->forget('formData');
    }

    public function getUniqueId($product, $request)
    {
        if (isset($request['variation_size_id'])) {
            $size = $this->productService->getProductSize($request['variation_size_id']);
            return $product->id . '_' . $size->id;
        } else {
            return $product->id;
        }
    }

    public function checkUniqueIdOnCart($uniqueId)
    {
        return Cart::search(function ($cartItem, $rowId) use ($uniqueId) {
            return $cartItem->id === $uniqueId;
        });
    }

    public function updateOrAddToCart($existingItem, $product, $request, $uniqueId)
    {
        if ($existingItem->isNotEmpty()) {
            // Item already exists, update the quantity
            Cart::update($existingItem->first()->rowId, $existingItem->first()->qty + $request['quantity']);
        } else {
            // Item does not exist, add a new item
            Cart::add([
                'name' => $product->name,
                'id' => $uniqueId,
                'qty' => $request['quantity'],
                'price' => $request['product_price'] ?? $product->price,
                'options' => [
                    'color' => isset($request['variation_color']) ? $request['variation_color'] : null,
                    'size' => isset($request['variation_size_id']) ? $request['variation_size_id'] : null,
                    'product' => $product,
                ],
            ]);
        }
    }

}
