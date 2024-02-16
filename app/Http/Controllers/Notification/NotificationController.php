<?php

namespace App\Http\Controllers\Notification;

use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\Notification\NotificationService;

class NotificationController extends Controller
{

    /**
     * @var NotificationService
     */
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {

        try {

            $this->notificationService->markAsRead();
            $notifications = $this->notificationService->getAuthNotificaitons();

            return view('dashboards.common.notifications', compact('notifications'));
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function destroy(Notification $notification)
    {
        try {

            if ($this->notificationService->deleteNotification($notification)) {
                return WebResponses::successRedirectBack('Notification deleted successfully');
            }

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

}
