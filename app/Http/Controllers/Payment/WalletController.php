<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\Payment\WalletService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    /**
     * @var WalletService
     */
    private $walletService;
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(WalletService $walletService, UserService $userService)
    {
        $this->walletService = $walletService;
        $this->userService = $userService;
    }

    public function vendorWallet()
    {
        $user = $this->userService->getLoggedInUser();
        $myTransactions = $this->walletService->walletTransactions($user);
        $payAmounts = $this->walletService->getMyPaymentsAmount();

        return view('dashboards.vendor.wallet', compact('user', 'myTransactions', 'payAmounts'));

    }
}
