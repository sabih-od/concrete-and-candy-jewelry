@extends('dashboards.user.index')

@section('content')

    <div class="col-lg-9 layout">
        <div class="totalPayment">
            <h3 class="heading">Payments History</h3>
        </div>
        <div class="recentOrders">
            <h4>Payment History</h4>
        </div>
        <div class="recentTable totalPayment-table tablecard">
            <div class="table-responsive-lg">
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Order Number</th>
                        <th scope="col">Total Qty</th>
                        <th scope="col">Total Cost</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Amount After Discount</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <x-invoice.invoice-list-component :invoices="$paymentInvoices['orders']" :pageType="'my_orders'"/>

                    </tbody>
                </table>


                <div class="col-md-12">
                    <nav class="pagination">
                        {{ $paymentInvoices['orders']->links('alerts.custom-pagination') }}
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <!-- section css end -->
    </div>
    </div>
    </section>
@endsection
