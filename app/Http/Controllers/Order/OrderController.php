<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Order\OrderService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class OrderController extends Controller
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

    public function index(Request $request, $page = null, $tab = null)
    {
        if ($request->ajax()) {
            return $this->orderService->datatable($page, $tab);
        }
        $orders = $this->orderService->getOrders($page);

        return view($this->orderService->orderIndexView($page), compact('orders'));

    }

    public function generatePDF(Order $invoice, $page)
    {
        $invoice = $this->orderService->getOrder($invoice, $page);
        $user = $this->userService->getLoggedInUser();
        $pdf = $this->orderService->generatePdf($invoice, $page, $user);


        return $pdf->download('invoice.pdf');
    }

}
