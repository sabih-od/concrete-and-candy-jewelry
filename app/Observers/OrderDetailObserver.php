<?php

namespace App\Observers;

use App\Events\GenerateNotification;
use App\Models\OrderDetail;

class OrderDetailObserver
{
    /**
     * Handle the OrderDetail "created" event.
     *
     * @param \App\Models\OrderDetail $orderDetail
     * @return void
     */
    public function created(OrderDetail $orderDetail)
    {

        $orderItemsVendor = $orderDetail->VendorProduct();
        event(new GenerateNotification([
            'user_id' => $orderItemsVendor->product->user->id,
            'notification' => "We are excited to inform you that a new order has been placed "
                . $orderItemsVendor->product->name . " by " . $orderItemsVendor->order->user->name . " one of your products
                 on Free-99! So start prepare your product",
        ]));

    }

    /**
     * Handle the OrderDetail "updated" event.
     *
     * @param \App\Models\OrderDetail $orderDetail
     * @return void
     */
    public function updated(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the OrderDetail "deleted" event.
     *
     * @param \App\Models\OrderDetail $orderDetail
     * @return void
     */
    public function deleted(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the OrderDetail "restored" event.
     *
     * @param \App\Models\OrderDetail $orderDetail
     * @return void
     */
    public function restored(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Handle the OrderDetail "force deleted" event.
     *
     * @param \App\Models\OrderDetail $orderDetail
     * @return void
     */
    public function forceDeleted(OrderDetail $orderDetail)
    {
        //
    }
}
