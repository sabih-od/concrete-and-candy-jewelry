<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryRequest;
use App\Http\Requests\VoucherRequest;
use App\Models\Category;
use App\Models\Voucher;
use App\Services\Voucher\VoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    /**
     * @var VoucherService
     */
    private $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    public function index(Request $request)
    {
        try {
            $vouchers = $this->voucherService->getAllVouchers();
            if ($request->ajax()) {
                return $this->voucherService->datatable();
            }
            return view('admin.pages.voucher.index', compact('vouchers'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function create()
    {
        try {
            return view('admin.pages.voucher.create');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function store(VoucherRequest $request)
    {
        try {
            $this->voucherService->createVoucher($request->all());

            return WebResponses::successRedirect('admin.voucher.index', 'Voucher Added successfully');

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function show(Voucher $voucher)
    {
        try {

            return view('admin.pages.voucher.edit', compact('voucher'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function update(VoucherRequest $request, Voucher $voucher)
    {
        $voucher = $this->voucherService->updateVoucher($voucher, $request->all());
        if ($voucher) {
            return WebResponses::successRedirect('admin.voucher.index', 'Voucher Updated successfully');
        }
        return WebResponses::errorRedirectBack('Voucher not found');
    }

    public function destroy(Voucher $voucher)
    {
        try {
            $this->voucherService->deleteVoucher($voucher);
            return WebResponses::successRedirect('admin.voucher.index', 'Voucher Deleted successfully');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

}
