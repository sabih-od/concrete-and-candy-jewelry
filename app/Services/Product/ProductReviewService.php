<?php

namespace App\Services\Product;


use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;


class ProductReviewService
{
    private static $instance;

    private $productModel;

    private $productReviewModel;

    private function __construct()
    {
        $this->productModel = new Product();
        $this->productReviewModel = new ProductReview();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ProductReviewService();
        }
        return self::$instance;
    }

    public function getReviewData($data)
    {
        $data = [
            'user_id' => Auth::user()->id ,
            'product_id' => $data['product_id'] ,
            'comment' => $data['comment'] ,
            'rating' => $data['rating'],
        ];

        return $data;
    }
    public function add($data)
    {
        $this->productReviewModel->create($this->getReviewData($data));
    }

    public function checkUserReviewCount($product_id)
    {
       return  $this->productReviewModel
           ->where('user_id',Auth::user()->id)
           ->where('product_id',$product_id)
           ->get()
           ->count();
    }


}
