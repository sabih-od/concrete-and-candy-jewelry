<?php

namespace App\Services\Payment\Gateways;


use App\Services\Cart\CartService;
use App\Services\User\UserService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class ConnectStripeService
{
    private static $instance;

//    public function __construct(UserService $userService)
//    {
//        $this->userService = $userService;
//    }


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new StripeCheckoutService();
        }
        return self::$instance;
    }


}
