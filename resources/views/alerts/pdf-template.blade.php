<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        ul {
            margin-left: 0 !important;
            padding-left: 0 !important;
            list-style: none !important;

        }

    </style>
</head>
<body>

<div class="col-lg-9 layout">
    <h2 class="mainHeadig">Invoice Detail</h2>
    <div class="profileSetting totalOrder">


        <div class="recentTable invoiceDetail">
            <div class="orderDetail">
                <div>
                    <ul>
                        <li><strong>Deliver TO:
                            </strong></li>
                        <li>
                            {{ $user->name ?? '' }}<br>
                            {{ $order->shipping_address ?? '' }}<br>
                            {{ $user->phone ?? '' }}
                        </li>
                    </ul>
                </div>
                <div class="mt-1">
                    <ul>
                        <li><strong>Order No:
                            </strong><span>{{ $order->order_number ?? '' }}
                                    </span></li>
                        {{--                                <li><strong>Account:</strong><span>0000 12345 678900</span></li>--}}
                        <li><strong>Date:</strong><span>{{ $user->created_at->format('y-m-d') }}</span></li>
                    </ul>
                </div>
            </div>

            <table class="table table-responsive-lg" style="margin-top: 4% !important;">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">SIZE</th>
                    <th scope="col">COLOR</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">QTY</th>
                    <th scope="col">TOTAL</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->details as $index => $item)
                    <tr class="gray">
                        <td>{{$index + 1 ?? ''}}</td>
                        <td>{{ $item->product->name ?? '' }}</td>
                        <td>{{ $item->size->name ?? 'No Size' }}</td>
                        <td class="d-flex justify-content-center pt-4">
                            @if(isset($item->color))
                                <div class="align-items-end"
                                     style="width: 20px; height: 20px; background-color: {{ $item->color }};"></div>
                            @else
                                No Color
                            @endif
                        </td>
                        <td>${{ $item->unit_price ?? '' }}</td>
                        <td>{{ $item->quantity ?? '' }}</td>
                        <td>${{ $item->subtotal ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Something went wrong!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="paymentInfo">
                <div class="mt-1">
                    <ul>
                        <li><strong>SUB TOTAL:</strong><span>${{ $order->total_price ?? 0.00 }}</span></li>
                        <li><strong>DISCOUNT:</strong><span>{{ $order->discount ?? 0.00 }}%</span></li>

                    </ul>
                </div>
                <div>
                    <ul>

                        <li class="total"><strong>TOTAL:</strong>
                            <span>${{ isset($order->total_amount_after_discount) ? $order->total_amount_after_discount : $order->total_price }}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</body>
</html>
