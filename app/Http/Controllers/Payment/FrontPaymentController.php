<?php

namespace App\Http\Controllers\Payment;

use App\Events\GenerateNotification;
use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Cart\CartService;
use App\Services\Order\OrderService;
use App\Services\Payment\Gateways\StripeCheckoutService;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Rules\UniqueEmail;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\CommissionService;
use Illuminate\Support\Facades\DB;

class FrontPaymentController extends Controller
{
    /**
     * @var CartService
     */
    public $cartService;
    /**
     * @var OrderService
     */
    public $orderService;
    /**
     * @var StripeCheckoutService
     */
    public $stripeCheckoutService;
    public $userService;

    public function __construct(CartService $cartService,
                                UserService $userService,
                                StripeCheckoutService $stripeCheckoutService,
                                OrderService $orderService

    )
    {
        $this->cartService = $cartService;
        $this->userService = $userService;
        $this->stripeCheckoutService = $stripeCheckoutService;
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        try {
            $data = $request->all();
            session()->put('formData', $request->all());
            if (!Auth::user()) {
                $request->validate([
                    'email' => ['required', 'email', new UniqueEmail],
                ]);
            }
            return view('front.pages.cart.payment', compact('data'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }

    }

    public function stripeCheckout(Request $request)
    {
        try {
            $stripeToken = $this->stripeCheckoutService
                ->checkFrontStripeToken($request->input('stripe_token'));

            DB::beginTransaction();

//            If user guest then create its account first
            if ($this->stripeCheckoutService->checkGuestUser(session()->get('formData'))) {
                $userData = $this->userService->addHashPassword(session()->get('formData'));
                $user = $this->userService->createUser($userData);
            } else {
                $user = $this->userService->getLoggedInUser();
            }
//            Payment Charge
            $charge = $this->stripeCheckoutService->frontCharge($stripeToken);

//            Create Order into DB
            if ($charge) {
                $cartData = $this->cartService->getCartContent();
                $data = $request->all();

                $order = $this->orderService->createOrder($user, $charge, $cartData, $data);

                if ($order) {
                    $this->cartService->removeWholeCart();
                }

                // If everything is successful, commit the transaction
                DB::commit();
                return WebResponses::successRedirect('front.orderSuccess', 'Order successfully purchased');
            }

            DB::rollback();
            return 'something went wrong while transaction';
        } catch (\Exception $e) {
            DB::rollback();
            return WebResponses::errorRedirectSpecificRoute('front.orderError', $e->getMessage());
        }

    }

    public function search(Request $request)
    {
        $product = Product::where('name', 'like', '%' . $request->search . '%')->first();
        if ($product) {
            return redirect()->route('front.shop.product', ['slug' => $product->slug]);
        }
        return WebResponses::successRedirectBack('Sorry! this name product not found');
    }


}
