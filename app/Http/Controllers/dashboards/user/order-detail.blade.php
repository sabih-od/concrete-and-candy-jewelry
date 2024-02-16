@extends('dashboards.user.index')

@section('content')

    <div class="col-lg-9 layout">
        <h2 class="mainHeadig">Order Detail</h2>
        <div class="profileSetting totalOrder">


            <div class="recentTable invoiceDetail orderinvoiceDetail">
                <div class="invoiceDtl position-relative">
                    <h2>Order</h2>

                    <form action="{{ route('return.order.item' , ['order_id' => $order->id]) }}" method="POST">
                        @csrf
                        <input hidden name="order_id" value="{{$order->id}}">
                        <button class="btn btn-danger returnBtn"
                                @if(now()->diffInDays($order->created_at) > $settings->product_return_days)
                                disabled
                                title="Return policy days have expired"
                            @endif
                        > Return
                        </button>
                    </form>

                </div>
                <div class="orderDetail">
                    <div class="orderdtlOne">
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
                        <div>
                            <ul>
                                <li><strong>Order No:
                                    </strong><span>{{ $order->order_number ?? '' }}
                                    </span></li>
                                {{--                                <li><strong>Account:</strong><span>0000 12345 678900</span></li>--}}
                                <li><strong>Date:</strong><span>{{ $order->created_at->format('y-m-d') }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive-lg">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">PRODUCT NAME</th>
                                <th scope="col">SIZE</th>
                                <th scope="col">COLOR</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">QTY</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">ACTION</th>
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
                                    <td>
{{--                                        @if(is_null($item->product->returnPolicy))--}}
{{--                                            <button class="btn btn-danger disabled">--}}
{{--                                                No Return--}}
{{--                                            </button>--}}
{{--                                        @else--}}
{{--                                            <button class="btn btn-danger" data-toggle="modal"--}}
{{--                                                    data-target="#returnOrderItemModel"--}}
{{--                                                    data-order-id="{{ $item->id }}"--}}
{{--                                                    @if(now()->diffInDays($order->created_at) > $settings->product_return_days)--}}
{{--                                                    disabled--}}
{{--                                                    data-toggle="tooltip" data-placement="top"--}}
{{--                                                    title="Return policy days have expired" @endif>--}}
{{--                                                Return--}}
{{--                                            </button>--}}
{{--                                        @endif--}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Something went wrong!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="paymentInfo">
                        <div class="mt-5">
                            {{--                            <ul class="pymntList">--}}
                            {{--                                <li><strong>Payment Info:</strong></li>--}}
                            {{--                                <li>--}}
                            {{--                                    Account: 1234567890<br>--}}
                            {{--                                    A/C Name:<br>--}}
                            {{--                                    Bank Details: Add your details--}}
                            {{--                                </li>--}}
                            {{--                            </ul>--}}
                            <ul>
                                <li><strong>SUB TOTAL:</strong><span>${{ $order->total_price ?? 0.00 }}</span></li>
                                <li><strong>DISCOUNT:</strong><span>${{ $order->discount ?? 0.00 }}</span></li>

                            </ul>
                        </div>
                        <div>
                            <ul>

                                <li class="total">TOTAL:
                                    <span>${{isset($order->total_amount_after_discount) ? $order->total_amount_after_discount : $order->total_price }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="invoiceFoter">
                    <ul>
                        <li><a href="tel:+11234567890"><img src="{{ asset('dashboard-assets/images/calicon.png') }}"
                                                            class="img-fluid"
                                                            alt="img"><span>+1 (123) 456 7890</span></a>
                        </li>
                        <li><a href="mailto:info@youremail.com"><img
                                    src="{{ asset('dashboard-assets/images/email-icon.png') }}"
                                    class="img-fluid" alt="img"><span>info@youremail.com</span></a>
                        </li>
                        <li><a href="#"><img src="{{ asset('dashboard-assets/images/loc-icon.png') }}" class="img-fluid"
                                             alt="img"><span>Space
                                    Needle 000 Broad St, Seattles</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- section css end -->
    </div>
    </div>
    </section>

    <div class="modal fade" id="returnOrderItemModel" tabindex="-1" role="dialog" aria-labelledby="setgallery"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalCenterTitle">{{ __('Request to return a order') }}<br/><span
                            style="font-size: 12px !important;">Note: Please enter the reason to check the return policy criteria</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="add-product-content1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-description">
                                    <div class="body-area">
                                        <form id="returnForm" action="{{ route('return.order.item') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="order_item_id" id="order_item_input">

                                            <textarea id="reason" name="return_reason" rows="4"
                                                      placeholder="Enter your reason here"
                                                      class="form-control" required></textarea>
                                            <input type="number" class="form-control mt-3" name="return_qty"
                                                   placeholder="Enter return quantity" required>

                                            <button type="submit" class="btn btn-primary mt-3 float-right">Submit
                                                Request
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $('#returnOrderItemModel').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var order_id = button.data('order-id');
                $(this).find('#order_item_input').val(order_id);
            });
        });

    </script>



@endsection
