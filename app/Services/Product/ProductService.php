<?php

namespace App\Services\Product;


use App\Models\Product;
use App\Models\ProductReturnPolicy;
use App\Models\ProductSize;
use App\Models\ProductVariation;
use App\Services\Payment\Gateways\StripeCheckoutService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * @property ProductSize productSizeModel
 */
class ProductService
{
    private static $instance;
    /**
     * @var Product
     */
    private $productModel;
    /**
     * @var ProductVariation
     */
    private $variationModel;
    /**
     * @var ProductReturnPolicy
     */
    private $productReturnPolicyModel;


    private function __construct()
    {
        $this->productModel = new Product();
        $this->variationModel = new ProductVariation();
        $this->productSizeModel = new ProductSize();
//        $this->productReturnPolicyModel = new ProductReturnPolicy();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ProductService();
        }
        return self::$instance;
    }

    public function getAllProducts($limit = null)
    {
        try {
            if ($limit != null) {
                return $this->productModel->with('category')->orderBy('created_at', 'desc')->limit($limit)->get();
            }

            if (Auth::check() && $this->checkVendor()) {
                return $this->productModel->getVendorProducts()->with('Category', 'user')->orderBy('created_at', 'desc')->get();
            }

            return $this->productModel->with('category')->orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getFeaturedProducts()
    {
        try {

            return $this->productModel->where('featured', 1)->with('category')->orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getMostPurchasedProducts($limit = null)
    {
        $mostPurchasedProducts = Product::withCount('orderDetails')
            ->orderByDesc('order_details_count');

        if ($limit !== null) {
            $mostPurchasedProducts->limit($limit);
        }
        return $mostPurchasedProducts->get();


    }

    public function getProducts($limit = null, $random = false, $latest = false)
    {
        $query = $this->productModel->query();

        if ($limit !== null) {
            $query->limit($limit);
        }
        if ($random) {
            $query->inRandomOrder();
        }
        if ($latest) {
            $query->latest();
        }

        return $query->with('Category')->get();
    }


    public function getProductsWithPagination($categorySlug = null, $searchParam = null)
    {
        if ($categorySlug != null) {
            return $this->productModel->whereHas('Category', function ($q) use ($categorySlug) {
                $q->getSlugCategory($categorySlug);
            })->searchProductName($searchParam)->paginate(12);
        }

        return $this->productModel->with('Category')->where('status', 1)->latest()->paginate(12);
//            ->searchProductName($searchParam)->paginate(12);
    }

    public function datatable()
    {
        $products = $this->getAllProducts();
        return DataTables::of($products)
            ->addColumn('category', function ($data) {
                return $data->Category ? $data->Category->name : " ";
            })
            ->addColumn('created_by', function ($data) {
                return $data->user ? $data->user->name : " ";
            })
            ->addColumn('action', function ($data) {

                if (Auth::user()->hasRole('vendor')) {
                    $editRoute = route('vendor.prod.edit', ['product' => $data->id]);
                    $deleteRoute = route('vendor.prod.destroy', ['product' => $data->id]);
                } else {
                    $editRoute = route('admin.prod.edit', ['product' => $data->id]);
                    $deleteRoute = route('admin.prod.destroy', ['product' => $data->id]);
                }

                return $data->status == 0 ?
                    '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>'
                    : '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function createProduct($productData)
    {
        try {

            DB::beginTransaction();

            $productData['user_id'] = Auth::user()->id;

            if (isset($productData['product_feature_check']) && $productData['product_feature_check'] == 1) {
                $productData['features'] = json_encode($productData['feature']);
            }

            $product = $this->productModel->create($productData);

            $product->addMedia($productData['photo'])->toMediaCollection('product_img');

            if (isset($productData['gallery'])) {
                $files = $productData['gallery'];
                foreach ($files as $key => $file) {
                    if (in_array($key, $productData['galval'])) {
                        $product->addMedia($file)->toMediaCollection('product_gallery');
                    }
                }
            }

            if (isset($productData['product_variation_check'])) {
                foreach ($productData['variation_sizes'] as $index => $size) {

                    $this->productVariation([
                        "product_id" => $product->id,
                        "size_id" => $size,
                        "color" => isset($productData['variation_colors'][$index]) ? $productData['variation_colors'][$index] : null,
                        "price" => $productData['variation_prices'][$index],
                    ]);

                }
            }

//            if (isset($productData['product_return'])) {
//                $this->productReturnPolicy([
//                    "product_id" => $product->id,
//                    "return_policy" => $productData['product_return_policy'],
//                ]);
//            }

//            if(Auth::user())
            DB::commit();

            return $product;

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }

    }

    public function productReturnPolicy($policyData)
    {
        $this->productReturnPolicyModel->create($policyData);
        return true;
    }

    public function productVariation($variationData)
    {
        $this->variationModel->create($variationData);
        return true;
    }

    public function getProductSize($id)
    {
        return $this->productSizeModel->find($id);
    }

    public function getProduct($productId)
    {
        return $this->productModel->find($productId);
    }

    public function updateProduct($product, $productData)
    {
        try {
            if ($product) {

                if (empty($productData['product_feature_check'])) {
                    $productData['features'] = null;
                } else {
                    $productData['features'] = json_encode($productData['feature']);

                }

                $product->update($productData);

                if (!empty($productData['photo'])) {
                    $product->clearMediaCollection('product_img');
                    $product->addMedia($productData['photo'])->toMediaCollection('product_img');
                }

                if (isset($productData['delete_gall_media_ids'])) {
                    foreach ($productData['delete_gall_media_ids'] as $deletedGalleryImage) {
                        $product->getFirstMedia('product_gallery')->where('id', $deletedGalleryImage)->delete();
                    }
                }

                if (isset($productData['gallery']) && $productData['gallery'] > 0) {
                    $files = $productData['gallery'];
                    foreach ($files as $key => $file) {
                        $product->addMedia($file)->toMediaCollection('product_gallery');
                    }
                }

                if (isset($productData['product_variation_check'])) {
                    ProductVariation::where('product_id', $product->id)->delete();

                    foreach ($productData['variation_sizes'] as $index => $size) {
                        $variation = [
                            "product_id" => $product->id,
                            "size_id" => $size,
                            "color" => isset($productData['variation_colors'][$index]) ? $productData['variation_colors'][$index] : null,
                            "price" => $productData['variation_prices'][$index],
                        ];
                        $this->productVariation($variation);
                    }
                } else {
//                IF HE RETURN PRODUCT-VARIATION-CHECK UNCHECK THAT MEAN HE DONT WANT VARIATIONS MORE SO WE DELETE PREV VARIATIONS TOO
                    $this->variationModel->where('product_id', $product->id)->delete();
                }

//                if (isset($productData['product_return'])) {
//                    $returnPolicy = ProductReturnPolicy::where('product_id', $product->id)->first();
//                    if ($returnPolicy) {
//                        $returnPolicy->update(['return_policy' => $productData['product_return_policy']]);
//                    } else {
//                        $this->productReturnPolicy([
//                            "product_id" => $product->id,
//                            "return_policy" => $productData['product_return_policy'],
//                        ]);
//                    }
//
//                } else {
//                    $this->productReturnPolicyModel->where('product_id', $product->id)->delete();
//                }


            } else {
                throw new \Exception("Product Not Found");
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public
    function deleteProduct($product)
    {
        try {
            $product->delete();
            return true;

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public
    function statusChange($product)
    {
        try {
            $product->status = $product->status == 1 ? 0 : 1;
            $product->save();
            return true;

        } catch (\Exception $exception) {
            return $exception->getMessage();
        }


    }

    public
    function minusStock($product, $quantity)
    {
        $product->stock_quantity = $product->stock_quantity - $quantity;
        $product->save();

        return true;
    }

    public
    function checkVendor()
    {
        return Auth::user()->hasRole('vendor');
    }

    public
    function productIndexView()
    {
        if ($this->checkVendor()) {
            return 'dashboards.vendor.products.index';
        }
        return 'admin.pages.products.index';
    }


    public
    function productCreateView()
    {
        if ($this->checkVendor()) {

            return 'dashboards.vendor.products.create';
        }
        return 'admin.pages.products.create';
    }

    public
    function productEditView()
    {
        if ($this->checkVendor()) {
            return 'dashboards.vendor.products.edit';
        }
        return 'admin.pages.products.edit';
    }

    public
    function productReturnRoute()
    {
        if ($this->checkVendor()) {
            return 'vendor.prods.index';
        }
        return 'admin.prods.index';
    }

}
