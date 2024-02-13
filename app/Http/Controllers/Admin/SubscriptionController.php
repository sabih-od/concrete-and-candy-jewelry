<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Models\Subscription;
use App\Services\Admin\SubscriptionService;
use Illuminate\Http\Request;
use App\Http\Requests\admin\SubscriptionRequest;


class SubscriptionController extends AdminBaseController
{


    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(Request $request)
    {
        $subscriptions = $this->subscriptionService->getAllSubscriptions();
        if ($request->ajax()) {
            return $this->subscriptionService->datatable();
        }
        return view('admin.pages.subscriptions.index', compact('subscriptions'));
    }


    public function create()
    {
        return view('admin.pages.subscriptions.create');
    }


    public function store(SubscriptionRequest $request)
    {
        try {
            $this->subscriptionService->createSubscription($request->all());
            return WebResponses::successRedirect('admin.subscriptions.index', 'Subscription Added successfully');

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function show(Subscription $subscription)
    {
        return view('admin.pages.subscriptions.edit', compact('subscription'));
    }


    public function update(Request $request, Subscription $subscription)
    {
        $subscription = $this->subscriptionService->updateSubscription($subscription, $request->all());
        if ($subscription) {
            return WebResponses::successRedirect('admin.subscriptions.index', 'Subscription Updated successfully');
        }
        return WebResponses::errorRedirectBack('Subscription not found');
    }


    public function destroy(Subscription $subscription)
    {
        $this->subscriptionService->deleteSubscription($subscription);
        return WebResponses::successRedirect('admin.subscriptions.index', 'Subscription Deleted successfully');
    }

}
