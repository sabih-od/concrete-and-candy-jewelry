<?php

namespace App\Services\Payment;


use App\Models\Product;
use App\Models\ProductReview;
use App\Models\VendorWallet;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\BalanceTransaction;
use App\Services\Payment\WalletService;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    private static $instance;
//    public  $walletService;
//
//    private function __construct(WalletService $walletService)
//    {
//        $this->walletService = $walletService;
//    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PaymentService();
        }
        return self::$instance;
    }



}
