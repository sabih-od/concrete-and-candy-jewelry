<?php

namespace App\Http\Controllers\Payment;

use App\Events\GenerateNotification;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\UserSubscription;
use App\Services\Admin\SubscriptionService;
use App\Services\Payment\Gateways\StripeCheckoutService;
use App\Services\User\UserSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    private $stripService;
    /**
     * @var SubscriptionService
     */
    private $userSubscriptionService;

    public function __construct(StripeCheckoutService $stripService, UserSubscriptionService $userSubscriptionService)
    {
        $this->stripService = $stripService;
        $this->userSubscriptionService = $userSubscriptionService;
    }


    public function becomeAVendorViaStripe(Subscription $subscription)
    {

        try {
            if($subscription->payment_type == 'one_time'){
                $package = [
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd', // or your desired currency code
                                'product_data' => [
                                    'name' => $subscription['title'],
                                ],
                                'unit_amount' => $subscription['total_price'] * 100,
                            ],
                            'quantity' => 1,
                        ],
                    ],
//                    dd($subscription['id']),
                    'subscription_id' => $subscription['id'],

                ];
                $this->userSubscriptionService->userSubscription($subscription);
                $success = $this->stripService->charge($package, $type = "becomeAVendor");
            }else{
                $success = $this->userSubscriptionService->userSubscription($subscription);
            }
            event(new GenerateNotification([
                'user_id' => Auth::user()->id,
                'notification' => Auth::user()->name . " Congratulations! We are delighted to inform you that
                 your vendor registration on Free-99 was successful."
            ]));

            if($subscription->payment_type == 'one_time')
            {
                return redirect($success);
            }
                return redirect()->back()->with('success', $success);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }


    }


    public function vendorSubscriptions(Subscription $subscription_id)
    {

        try {

            $userSubscription = $this->userSubscriptionService->userSubscription($subscription_id);

            return redirect()->route('vendor.dashboard')->with('success', $userSubscription);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function stripeCancel($type = null)
    {
        try {

            if ($type != null) {
                return redirect()->route('user.dashboard')->with('success', "Transaction Canceled Successfully");
            } else {

                return redirect()->route('front.cart')->with('success', "Transaction Canceled Successfully");
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
