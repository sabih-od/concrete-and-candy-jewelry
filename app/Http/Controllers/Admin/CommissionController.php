<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commision;
use App\Services\Admin\CommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }
    public function commission()
    {
        $commission = $this->commissionService->getCommision();
        return view('admin.pages.commission.my_commision',compact('commission'));
    }

    public function commissionEdit(Request $request)
    {
        try {
            $requestData = $request->except('_token');
            $this->commissionService->createCommission($requestData);

            DB::commit();
            return redirect()->route('admin.commission')->with('success', 'Commission edited successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
