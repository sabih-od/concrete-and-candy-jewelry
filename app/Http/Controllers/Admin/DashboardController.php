<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderService;
use App\Services\Payment\WalletService;
use App\Services\User\UserService;

class DashboardController extends Controller
{
    protected $userService;
    protected $walletService;
    protected $orderService;

    public function __construct(
        UserService $userService,
//        WalletService $walletService,
        OrderService $orderService
    )
    {
        $this->userService = $userService;
//        $this->walletService = $walletService;
        $this->orderService = $orderService;
    }

    public function dashboard()
    {
//        $reports = $this->walletService->dashboardReports();
        $users = $this->userService->getAllUsers(5);
        $orders = $this->orderService->getAllOrder(5);
        return view('admin.pages.dashboard', compact('users', 'orders'));
    }

    public function usersIndex()
    {
        return view('admin.pages.users.user-index');
    }

    public function users()
    {
        return view('admin.pages.users.user-index');
    }

    public function productIndex()
    {
        return view('admin.pages.product.product-index');
    }

    public function productCreate()
    {
        return view('admin.pages.product.product-create');
    }


}
