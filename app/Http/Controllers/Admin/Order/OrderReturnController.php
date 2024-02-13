<?php

namespace App\Http\Controllers\Admin\Order;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderReturnService;
use Illuminate\Http\Request;

class OrderReturnController extends Controller
{

    /**
     * @var OrderReturnService
     */
    private $orderReturnService;

    public function __construct(OrderReturnService $orderReturnService)
    {
        $this->orderReturnService = $orderReturnService;
    }

    public function store(Request $request, $order_id = null)
    {
        try {

            if ($order_id != null) {
                $orderItems = $this->orderReturnService->getOrderItems($order_id);

                foreach ($orderItems as $item) {
                    $createReturnOrder = $this->orderReturnService->createReturnOrder([
                        'order_item_id' => $item->id,
                        'return_reason' => "Order Returned",
                        'return_qty' => $item->quantity
                    ]);
                }
            } else {
                $createReturnOrder = $this->orderReturnService->createReturnOrder($request->all());

            }

            if ($createReturnOrder instanceof \Exception) {
                return WebResponses::errorRedirectBack($createReturnOrder->getMessage());
            }
            return WebResponses::successRedirectBack('Order return submitted successfully');

        } catch (\Exception $exception) {
            return WebResponses::errorRedirectBack($exception->getMessage());
        }
    }
}
