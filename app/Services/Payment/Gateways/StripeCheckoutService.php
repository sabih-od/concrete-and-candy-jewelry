<?php

namespace App\Services\Payment\Gateways;


use App\Services\Cart\CartService;
use App\Services\User\UserService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class StripeCheckoutService
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


    public static function charge($input, $type , $product = null)
    {
        try {
            \Stripe\Stripe::setApiKey(\Config::get('services.stripe.secret'));

            if($type = "productPrice" && $product!=null ){
                $success_url = route('vendor.productListing.priceCharged', ["product" => $product->id]);
                $cancel_url = route('stripe.cancel', ["type" => $type]);
            }
            else if ($type = "becomeAVendor"){
                $success_url = route('vendor.prods.index');
                $cancel_url = route('vendor.prods.index');
            }
            else{
                $success_url = route('user.dashboard');
                $cancel_url =  route('stripe.cancel');
            }

            $checkoutSession = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [$input['line_items']],
                'mode' => 'payment',
                'success_url' => $success_url,
                'cancel_url' => $cancel_url,
            ]);

            // Redirect the user to the Checkout Session URL
            return $checkoutSession->url;

        } catch (\Stripe\Exception\ApiErrorException $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            // Catch any other exceptions
            return $e->getMessage();
        }

    }

    public function frontCharge($stripeToken)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $totalAmount = session('voucher') ? session('voucher') : Cart::subtotal();

        return Stripe\Charge::create([
            // the amount to charge in cents (multiply by 100 because Stripe uses the smallest currency unit
            "amount" => floatval($totalAmount) * 100,
            "currency" => "usd",
            "source" => $stripeToken,
            "description" => "Test payment free-99"
        ]);
    }


    public function checkGuestUser($formData)
    {
        if(!Auth::user())
        {
            if(!isset($formData['email']) && !isset($formData['password']))
            {
                return redirect()->route('front.checkout.form')->with('error', 'Your data required');
            }
            return true;
        }
        return false;
    }

    public function checkFrontStripeToken($stripeToken)
    {
        if (!isset($stripeToken)) {
            return redirect()->back()->with('error', 'Stripe token is missing or invalid.');
        }
        return $stripeToken;
    }

}
