<?php

namespace App\Services\Order;

use App\Helpers\WebResponses;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UserSubscription;
use App\Models\VendorWallet;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Admin\CommissionService;
use Illuminate\Support\Facades\Session;

class OrderService
{
    private static $instance;
    /**
     * @var UserSubscription
     */
    private $orderModel;

    /**
     * @var OrderDetail
     */
    private $orderDetailModel;

    private $vendorWalletModel;
    /**
     * @var Product
     */
    private $productModel;


    private function __construct()
    {
        $this->orderModel = new Order();
        $this->orderDetailModel = new OrderDetail();
//        $this->vendorWalletModel = new VendorWallet();
        $this->productModel = new Product();

    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new OrderService();
        }
        return self::$instance;
    }

    public function getOrderData($user, $charge, $data)
    {
        return [
            'user_id' => $user->id,
            'status' => 'completed',
            'shipping_address' => isset($data['shippingAddress']) ? $data['shippingAddress'] : $user->address,
            'discount' => session('voucher') ? session('voucher')['discounted_amount'] : '0',
            'total_price' => Cart::subtotal(),
            'total_items' => Cart::count(),
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'order_number' => "ORD" . '-' . mt_rand(10000000, 99999999),
            'total_amount_after_discount' => session('voucher') ?
                session('voucher')['total_amount_with_discount'] : null
        ];
    }

    public function getOrderDetailData($order, $cart)
    {

        return [
            'order_id' => $order->id,
            'product_id' => $cart->options->product->id,
            'quantity' => $cart->qty,
            'size_id' => $cart->options->size,
            'color' => $cart->options->color,
            'unit_price' => $cart->price,
            'subtotal' => $cart->price * $cart->qty,
            'invoice_number' => "INV" . '-' . mt_rand(10000000, 99999999),
        ];
    }

    public function getWalletData($id, $cart, $commision, $user)
    {
        $adminProductCommision = $commision->calculateAdminCommision($cart->price * $cart->qty);
        return [
            'order_detail_id' => $id,
            'user_id' => $user->id,
            'vendor_id' => $cart->options->product->user->id,
            'amount_paid' => $cart->options->product->user->hasRole('admin') ? '-' : '0',
            'amount_remaining' => $cart->options->product->user->hasRole('admin') ? '-' : ($cart->price * $cart->qty) - $adminProductCommision,
            'status' => $cart->options->product->user->hasRole('admin') ? 'transferred' : 'pending',
            'transaction_id' => $cart->options->product->user->hasRole('admin') ? '-' : null,
            'admin_commision' => $cart->options->product->user->hasRole('admin') ? $cart->price * $cart->qty : $adminProductCommision,
            'total_amount' => $cart->price * $cart->qty,
        ];
    }

    public function createOrder($user, $charge, $cartData, $data)
    {
        $order = $this->orderModel->create($this->getOrderData($user, $charge, $data));

        foreach ($cartData as $cart) {
            $orderDetail = $this->orderDetailModel->create($this->getOrderDetailData($order, $cart));
//            $this->vendorWalletModel->create($this->getWalletData($orderDetail->id, $cart, $user));

            $vendorProduct = $this->productModel->where('id', $cart->options->product->id)->with('user')->first();
            $vendorProduct->minusProductStock($cart->qty);

        }

        Session::forget('voucher');

        return $order;
    }

    public function datatable($page, $tab)
    {
        try {

//        Else is for admin orders listing depends on its column and if condition for dashboards
            if ($page) {
                $query = [];

                if ($page == "my_orders") {
                    $query = $this->orderModel->where('user_id', Auth::user()->id)->with('details.product');
                } elseif ($page == "product_orders") {

                    $query = $this->orderModel->whereHas('details', function ($query) {
                        $query->whereHas('product', function ($q) {
                            $q->where('user_id', Auth::user()->id);
                        });
                    });

                }
                switch ($tab) {
                    case 'pending_orders':
                        $query->where('status', 'pending');
                        break;
                    case 'completed_orders':
                        $query->where('status', 'completed');
                        break;

                }

                $orders = $query->orderBy('created_at', 'desc')->get();

                return DataTables::of($orders)
                    ->addColumn('order_number', function ($data) {
                        return isset($data->orde_number) ? $data->orde_number : "Wanr1648101347";
                    })
                    ->addColumn('total_qty', function ($data) {
                        return $data->total_items ? $data->total_items : "0";
                    })
                    ->addColumn('total_price', function ($data) {
                        return $data->total_price ? $data->total_price : "0";
                    })
                    ->addColumn('discount', function ($data) {
                        return $data->discount ? $data->discount . '%' : "0%";
                    })
                    ->addColumn('total_amount_after_discount', function ($data) {
                        return isset($data->total_amount_after_discount) ? $data->total_amount_after_discount . '$' : '-';
                    })
                    ->addColumn('payment_method', function ($data) {
                        return $data->payment_method ? $data->payment_method : "0";
                    })
                    ->addColumn('status', function ($data) {
                        return $data->status ? $data->status : " ";
                    })
                    ->addColumn('action', function ($data) use ($page) {
                        $url = route('my.order.details', ['order' => $data->id, 'page' => $page]);
                        return '<a href="' . $url . '"><img src="' . asset('dashboard-assets/images/eye.png') . '" alt="image" class="img-fluid"></a>';
                    })
                    ->rawColumns(['action'])
                    ->toJson();

            } else {

                $orders = $this->getAllOrder();

                return DataTables::of($orders)
                    ->addColumn('user_id', function ($data) {
                        return $data->User ? $data->User->name : " ";
                    })->addColumn('created_at', function ($data) {
                        return $data->created_at ? $data->created_at->format('d-M-Y') : " ";
                    })
                    ->addColumn('action', function ($data) {

                        if (Auth::user()->hasRole('admin')) {
                            $editRoute = route('my.order.details', ['order' => $data->id, 'page' => 'admin']);
                        } else {
                            $editRoute = null;
                        }
                        return
                            '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm">View Order Detail</a>&nbsp;';
                    })
                    ->rawColumns(['action'])
                    ->toJson(); // Returning Json Data To Client Side
            }
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }

    }

    public function detailDatatable($order)
    {
        $orderDetail = Order::where('id', $order->id)->with('user', 'details.product')->first();

        return DataTables::of($orderDetail->details)
            ->addColumn('product_id', function ($data) {
                return $data->product ? $data->product->name : " ";
            })
            ->addColumn('size_id', function ($data) {
                return $data->size ? $data->size->name : " ";
            })
            ->addColumn('color', function ($data) {
                return $data->color ? '<div style="width: 20px; height: 20px; background-color:' . $data->color . ';"></div>' : " ";
            })
            ->rawColumns(['color']) // Specify which columns should allow raw HTML content
            ->toJson(); // Returning Json Data To Client Side
    }

    public function getAuthUserOrders()
    {
        try {
            $query = Order::where('user_id', Auth::user()->id)->with('details.product');

            $data['ordersCount'] = $query->get();
            $data['orders'] = $query->orderBy('created_at', 'desc')->paginate(10);

            return $data;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getVendorOrders()
    {
        try {

            $query = $this->orderModel->whereHas('details', function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->where('user_id', Auth::user()->id);
                });
            })->with(['details' => function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->where('user_id', Auth::user()->id);
                });
            }]);

            $data['ordersCount'] = $query->get();
            $data['orders'] = $query->orderBy('created_at', 'desc')->paginate(10);

            return $data;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAuthUserInvoices()
    {
        return $this->orderDetailModel->whereHas('order', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->with('product', 'order')->orderby('created_at', 'desc')->paginate(10);

    }

    public function getOrder($order, $type)
    {
        if ($type == "my_orders" || $type == "admin") {
            return $this->orderModel->where('id', $order->id)->with('user', 'details.product')->first();
        } else {
            return $this->orderModel->where('id', $order->id)->with(['details' => function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->where('user_id', Auth::user()->id);
                });
            }])->first();
        }
    }

    public function getAllOrder($records = null)
    {
        if ($records != null) {
            return $this->orderModel->latest()->take($records)->get();
        }
        return $this->orderModel->all();
    }

    public function getOrders($pageType)
    {
        if ($pageType == "my_orders") {
            return $this->getAuthUserOrders();
        } else if ($pageType == 'admin') {
            return $this->getAllOrder();
        }
        return $this->getVendorOrders();
    }

    public function orderIndexView($pageType)
    {
        if ($pageType == "my_orders") {
            return 'dashboards.user.total-orders';
        } else if ($pageType == 'admin') {
            return 'admin.pages.orders.index';
        } else if ($pageType == "product_orders") {
            return 'dashboards.vendor.total-orders';
        }
    }

    public function orderDetailView($pageType)
    {
        if ($pageType == "my_orders") {
            return 'dashboards.user.order-detail';
        } else if ($pageType == 'admin') {
            return 'admin.pages.orders.order-detail';
        } else if ($pageType == "product_orders") {
            return 'dashboards.vendor.order-detail';
        }
    }

    public function generatePdf($order, $page, $user)
    {
        return PDF::loadView('alerts.pdf-template', compact('order', 'user'));

    }

}
