<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Models\Size;
use App\Services\Admin\ProductSizeService;
use Illuminate\Http\Request;

class ProductSizeController extends AdminBaseController
{
    protected $productSizeService;

    public function __construct(ProductSizeService $productSizeService)
    {
        $this->productSizeService = $productSizeService;
    }

    public function index(Request $request)
    {
        $sizes = $this->productSizeService->getAllSizes();
        if ($request->ajax()) {
            return $this->productSizeService->datatable();
        }
        return view('admin.pages.sizes.index', compact('sizes'));
    }


    public function create()
    {
        return view('admin.pages.sizes.edit');
    }


    public function store(Request $request)
    {
        try {
            $this->productSizeService->createSize($request->all());
            return WebResponses::successRedirect('admin.sizes.index', 'Size Added successfully');

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function show(Size $size)
    {
        return view('admin.pages.sizes.edit', compact('size'));
    }


    public function update(Request $request, Size $size)
    {
        $size = $this->productSizeService->updateSize($size, $request->all());
        if ($size) {
            return WebResponses::successRedirect('admin.sizes.index', 'Subscription Updated successfully');
        }
        return WebResponses::errorRedirectBack('Size not found');
    }


    public function destroy(Size $productSize)
    {
//        $this->subscriptionService->deleteSubscription($subscription);
//        return $this->successRedirect('admin.sizes.index', 'Subscription Deleted successfully');
    }
}
