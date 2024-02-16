<?php

namespace App\Observers;

use App\Events\GenerateNotification;
use App\Models\Product;
use App\Models\ProductVariation;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */


    public function creating(Product $product)
    {
        $slug = \Str::slug($product->name);

        $count = Product::where('slug', $slug)->count();

        if ($count > 0) {
            $suffix = rand(1111, 9999);
            $slug .= '-' . $suffix;
        }

        // Assign the unique slug to the product
        $product->slug = $slug;
    }

    public function created(Product $product)
    {
        $productCreator = $product->user()->first();

        event(new GenerateNotification([
            'user_id' => $product->user_id,
            'notification' => $productCreator->name . " Congratulations! Your product " . $product->name .
                " has been successfully created on our marketplace. We will review and list your product shortly.",
        ]));
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $product->clearMediaCollection('product_img', 'product_gallery');

        ProductVariation::where('product_id', $product->id)->delete();
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param \App\Models\Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
