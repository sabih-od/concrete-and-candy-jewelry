<table class="table table-striped customTable">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Order Number</th>
        <th scope="col">Total Qty</th>
        <th scope="col">Total Amount</th>
        <th scope="col">Discount</th>
        <th scope="col">Amount After Discount</th>
        <th scope="col">Payment Method</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    @forelse($orders as $order)
        <tr>
            <td>
                <div class="detailMain">
                    <div class="title mb-0">
                        <h6>{{ $order->order_number ?? "Wanr1648101347" }}</h6>
                    </div>
                </div>
            </td>
            <td>{{ $order->total_items ?? ''}}</td>
            <td>{{ $order->total_price ?? '' }}$</td>
            <td>{{ $order->discount ?? '' }}%</td>
            <td>{{ isset($order->total_amount_after_discount) ? $order->total_amount_after_discount.'$' : '-' }}</td>
            <td>{{ $order->payment_method ?? '' }}</td>
            <td>{{ $order->status ?? '' }}</td>
            <td>
                <div class="actionBtn">
                    <a href="{{ route('my.order.details' , ['order' => $order->id , 'page'=> $pageType]) }}"><img
                            src="{{ asset('dashboard-assets/images/eye.png') }}"
                            alt="image"
                            class="img-fluid"></a>
                </div>
            </td>
        </tr>

    @empty

        <tr>
            <td colspan="8" class="text-center">No record found!</td>
        </tr>

    @endforelse


    </tbody>
</table>

<div class="col-md-12">
    <nav class="pagination">
        {{ $orders->links('alerts.custom-pagination') }}
    </nav>
</div>

