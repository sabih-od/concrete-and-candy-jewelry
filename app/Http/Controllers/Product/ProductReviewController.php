<?php

namespace App\Http\Controllers\Product;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Product\ProductReviewService;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    protected $productService;


    public function __construct(
        ProductReviewService $productReviewService
    )
    {
        $this->productReviewService = $productReviewService;
    }


    public function index()
    {

    }

    public function store(Request $request)
    {
        try
        {
            if( $this->productReviewService->checkUserReviewCount($request->product_id) < 1  ){
                $this->productReviewService->add($request->all());
                return back()->with('success', 'Product Review Added successfully');
            }
            else{
                return back()->with('error', 'You already review this product');
            }
        }
        catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


}
