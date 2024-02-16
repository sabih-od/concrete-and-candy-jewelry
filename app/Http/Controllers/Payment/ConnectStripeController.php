<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Auth;

class ConnectStripeController extends Controller
{
    public function connectVendor(Request $request)
    {
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $user = auth::user();

            if (is_null($user->stripe_account_id)) {
                $expressAccount = $stripe->accounts->create(['type' => 'express']);
                $user->stripe_account_id = $expressAccount->id;
                $user->save();
            }

            $account_link = $stripe->accountLinks->create([
                'account' => $user->stripe_account_id,
                'refresh_url' => route('vendor.wallet'),
                'return_url' => route('vendor.wallet'),
                'type' => 'account_onboarding',
            ]);

            return redirect($account_link->url);

        } catch (\Exception $e) {
//            dd($e);
            $request->session()->flash('error', 'Connecting failed!');
            return redirect()->route('vendor.wallet');
        }
    }

}
