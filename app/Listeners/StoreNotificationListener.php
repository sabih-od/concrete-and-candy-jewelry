<?php

namespace App\Listeners;

use App\Events\GenerateNotification;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\GenerateNotification $event
     * @return void
     */
    public function handle(GenerateNotification $event)
    {
        $notify = $event->notificationData;
        $notification = new Notification();
        $notification->notify_id = $notify['user_id'];
        $notification->content_body = $notify['notification'];
        $notification->save();
    }
}
