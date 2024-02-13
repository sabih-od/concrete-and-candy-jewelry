<?php

namespace App\Services\Order;

use App\Events\GenerateNotification;
use App\Helpers\WebResponses;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UserSubscription;
use App\Models\VendorWallet;
use App\Traits\PHPCustomMail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Admin\CommissionService;
use Illuminate\Support\Facades\Session;

class OrderReturnService
{

    use PHPCustomMail;

    private static $instance;
    /**
     * @var OrderDetail
     */
    private $orderDetail;
    /**
     * @var VendorWallet
     */
    private $vendorWallet;

    private function __construct()
    {
        $this->orderDetail = new OrderDetail();
        $this->vendorWallet = new VendorWallet();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new OrderReturnService();
        }
        return self::$instance;
    }

    public function createReturnOrder($orderReturnData)
    {
        try {
            DB::beginTransaction();

            $orderItem = $this->orderDetail->with('product.returnPolicy', 'product.user', 'order.user')->findOrFail($orderReturnData['order_item_id']);

            if ($orderItem->product->returnPolicy != null) {
                if ($orderReturnData['return_qty'] > $orderItem->quantity) {
                    throw new \Exception('Returns are limited to the original quantity purchased.');
                }

                if (!is_null($orderItem->return_date)) {
                    throw new \Exception('Return request already submitted');
                }

                $orderItem->update([
                    'return_date' => today(),
                    'return_reason' => $orderReturnData['return_reason'],
                    'return_qty' => $orderReturnData['return_qty'],
                ]);

                $this->vendorWallet->where('order_detail_id', $orderItem->id)->update([
                    'status' => 'refund'
                ]);

                $this->customMail(
                    'support@free99us.com',
                    $orderItem->product->user->email,
                    'Product Return Request',
                    "Dear " . $orderItem->product->user->name . ", a return request has been submitted for your order number " .
                    $orderItem->order->order_number . " with the reason: '" . $orderReturnData['return_reason'] . "'. " .
                    "We appreciate your prompt attention to this matter. Thank you."
                );

                DB::commit();

                return $orderItem;
            }

            DB::rollBack();
            return $orderItem;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function getOrderItems($orderId)
    {
        return OrderDetail::where('order_id', $orderId)->with('product.user', 'order.user')->get();

    }


}
