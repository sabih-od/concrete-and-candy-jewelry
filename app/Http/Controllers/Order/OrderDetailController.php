<?php

namespace App\Http\Controllers\Order;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Order\OrderService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(OrderService $orderService, UserService $userService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function index(Request $request, Order $order, $page)
    {
        try {

            if ($request->ajax()) {
                return $this->orderService->detailDatatable($order);
            }

            $order = $this->orderService->getOrder($order, $page);
            $user = $this->userService->getLoggedInUser();
            
            return view($this->orderService->orderDetailView($page), compact('order', 'user'));

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

}
