<?php

namespace App\Http\Controllers\User;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Services\User\UserSubscriptionService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function dashboard()
    {
        $user = Auth::user();
        $orders = $this->orderService->getAuthUserOrders();
        return view('dashboards.user.dashboard', compact('user', 'orders'));

    }

    public function userBecomeVendor()
    {

        return view('dashboards.user.become-vendor');

    }

    public function userPaymentHistory()
    {
        try {

            $paymentInvoices = $this->orderService->getAuthUserOrders();
            return view('dashboards.user.payments-history', compact('paymentInvoices'));

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

}
