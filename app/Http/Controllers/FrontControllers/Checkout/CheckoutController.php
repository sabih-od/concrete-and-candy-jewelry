<?php

namespace App\Http\Controllers\FrontControllers\Checkout;

use App\Http\Controllers\Controller;
use App\Services\Admin\SubscriptionService;
use App\Services\Payment\Gateways\StripeCheckoutService;
use App\Services\Payment\PaymentService;
use App\Services\User\UserSubscriptionService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }


    public function index()
    {
        return view('front.pages.cart.checkout');
    }

    public function success()
    {
        return view('front.pages.orderSuccess');
    }

}
