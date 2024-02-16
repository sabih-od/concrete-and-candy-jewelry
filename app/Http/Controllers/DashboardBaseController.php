<?php

namespace App\Http\Controllers;

use App\Services\Admin\SubscriptionService;
use App\Services\User\UserSubscriptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardBaseController extends Controller
{

    public function __construct(
    )
    {
    }

    public function profileSetting()
    {
        return view('dashboards.common.profile-settings');
    }

//    public function subscriptions()
//    {
//        $subscriptions = $this->subscriptions->getAllSubscriptions();
//        $checkSubscription = Auth::user()->userSubscription()->first();
//
//        return view('dashboards.common.subscriptions', compact('subscriptions', 'checkSubscription'));
//    }

    public function orderSuccess()
    {
        return view('front.pages.orderSuccess');
    }

    public function orderError()
    {
        return view('front.pages.orderError');

    }
}
