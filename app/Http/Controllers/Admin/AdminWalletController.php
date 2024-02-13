<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Payment\WalletService;

class AdminWalletController extends Controller
{
    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index(Request $request)
    {
        $wallets = $this->walletService->getWallets();

        if ($request->ajax()) {
            return $this->walletService->datatable();
        }

        return view('admin.pages.wallets.index', compact('wallets'));
    }
}
