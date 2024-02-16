<?php

namespace App\Http\Controllers\Product;

use App\Helpers\APIResponse;
use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVisitorController extends Controller
{


    public function trackVisitor(Product $product, Request $request)
    {
        try {
            $fingerprint = $request->input('fingerprint');
            $product->visitors()->firstOrCreate([
                'fingerprint' => $fingerprint,
                // Add other conditions if needed
            ], [
                'product_id' => $product->id,
                // Add other data to be saved
            ]);
            $productVisitors = $product->visitors()->get();
            return APIResponse::success('Successful', ['VisitorCount' => count($productVisitors)], 200);

        } catch (\Exception $exception) {
            return APIResponse::error($exception->getMessage());
        }
    }

}
