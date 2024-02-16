<?php

namespace App\Http\Controllers\Product;

use App\Helpers\APIResponse;
use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProductRequest;
use App\Models\Product;
use App\Services\Payment\Gateways\StripeCheckoutService;
use App\Services\Product\ProductService;
use App\Services\User\UserService;

use App\Services\Admin\CategoryService;
use App\Services\Admin\ProductSizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    protected $productService;
    protected $categoryService;
    protected $productSizeService;
    protected $userService;
    protected $stripService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        ProductSizeService $productSizeService,
        UserService $userService
//        StripeCheckoutService $stripService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productSizeService = $productSizeService;
        $this->userService = $userService;
//        $this->stripService = $stripService;


    }

    public function index(Request $request)
    {
        $product = $this->productService->getAllProducts();

        if ($product instanceof \Exception) {
            return WebResponses::errorRedirectBack($product->getMessage());
        }

        if ($request->ajax()) {
            return $this->productService->datatable();
        }

        return view($this->productService->productIndexView(), compact('product'));
    }

    public function create()
    {
        try {

            $productSizes = $this->productSizeService->getAllSizes();
            $categories = $this->categoryService->getAllCategories();

            return view($this->productService->productCreateView(), compact('productSizes', 'categories'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function store(ProductRequest $request)
    {
        $create = $this->productService->createProduct($request->all());

        if ($create instanceof \Exception) {
            return \redirect()->back()->with('error', $create->getMessage());
        }

        return redirect()->route($this->productService->productReturnRoute())
            ->with('success', 'Product Added successfully');
    }

    public function productListingPriceCharged(Product $product)
    {
        try {
            $product->update(['status' => 1]);
            return redirect()->route('vendor.prods.index')->with('success', 'Product Added Successfully & Payment also succeed');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Product $product)
    {
        try {
            $productSizes = $this->productSizeService->getAllSizes();
            $categories = $this->categoryService->getAllCategories();

            return view($this->productService->productEditView(),
                compact('product', 'productSizes', 'categories'));

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function update(Request $request, Product $product)
    {
        $product = $this->productService->updateProduct($product, $request->all());

        if ($product instanceof \Exception) {
            return WebResponses::errorRedirectBack($product->getMessage());
        }

        return redirect()->route($this->productService->productReturnRoute())
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product = $this->productService->deleteProduct($product);

        if ($product instanceof \Exception) {
            return APIResponse::exception($product->getMessage());
        }

        return APIResponse::success("", [], 200);

    }

    public function changeProductStatus(Product $product)
    {

        $product = $this->productService->statusChange($product);

        if ($product instanceof \Exception) {
            return APIResponse::exception($product->getMessage());
        }

        return APIResponse::success("", [], 200);

    }


}
