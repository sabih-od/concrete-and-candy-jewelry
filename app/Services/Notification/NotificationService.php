<?php

namespace App\Services\Notification;


use App\Models\Notification;
use App\Models\ProductSize;
use Illuminate\Support\Facades\Auth;

/**
 * @property ProductSize productSizeModel
 */
class NotificationService
{
    private static $instance;
    /**
     * @var Notification
     */
    private $notificationModel;


    private function __construct()
    {
        $this->notificationModel = new Notification();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new NotificationService();
        }
        return self::$instance;
    }

    public function getAuthNotificaitons()
    {
        return $this->notificationModel->where('notify_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
    }

    public function markAsRead()
    {

        $this->notificationModel->where('notify_id', Auth::user()->id)->update([
            'is_read' => 1,
        ]);

        return true;
    }

    public function deleteNotification($notification)
    {
        try {
            $notification->delete();
            return true;

        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


}
