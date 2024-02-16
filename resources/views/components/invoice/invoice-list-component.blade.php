@forelse($invoices as $invoice)
    <tr>
        <td>
            <div class="detailMain">
                <div class="title mb-0">
                    <h6>{{ $invoice->order_number ?? "Wanr1648101347" }}</h6>
                </div>
            </div>
        </td>
        <td>{{ $invoice->total_items ?? ''}}</td>
        <td>{{ $invoice->total_price ?? '' }}$</td>
        <td>{{ $invoice->discount ?? '' }}%</td>
        <td>{{ $invoice->total_amount_after_discount ? $invoice->total_amount_after_discount.'$' : '-' }}</td>
        <td>{{ $invoice->payment_method ?? '' }}</td>
        <td>{{ $invoice->status ?? '' }}</td>
        <td>
            <div class="actionBtn">
                <a class="themeBtn" href="{{ route('order.pdf', ['invoice' => $invoice->id, 'page'=> $pageType]) }}"
                   target="_blank">
                    PDF <i class="fas fa-download"></i> </a>
                <a href="{{ route('my.order.details' , ['order' => $invoice->id , 'page'=> $pageType]) }}"
                   class="themeBtn">View</a>
            </div>
        </td>
    </tr>

@empty

    <tr>
        <td colspan="8">Sorry No invoices yet!</td>
    </tr>

@endforelse
