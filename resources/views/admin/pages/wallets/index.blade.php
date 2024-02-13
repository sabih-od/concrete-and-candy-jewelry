@extends('admin.layout.admin')
@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="page-title-box">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mt-0 header-title">Wallets Listing</h4>
                            </div>
                            <table id="geniustable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Product Quantity</th>
                                    <th>Product Vendor</th>
                                    <th>Total Amount</th>
                                    <th>Admin Commision</th>
                                    <th>Amount Paid</th>
                                    <th>Amount Remaining</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
{{--                                    <th>Action</th>--}}
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('alerts.delete-modal')

@endsection

@section('script')

    {{--    Routes for hitting ajax--}}
    <script>
        var indexRoute = '{{ route("my.wallets.index") }}';

        var moduleName = '{{ request()->segment(2) }}';

        var columnsConfig = [
            {data: 'order_detail_id', name: 'order_detail_id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'product', name: 'product'},
            {data: 'product_quantity', name: 'product_quantity'},
            {data: 'vendor_id', name: 'vendor_id'},
            {data: 'total_amount', name: 'total_amount'},
            {data: 'admin_commision', name: 'admin_commision'},
            {data: 'amount_paid', name: 'amount_paid'},
            {data: 'amount_remaining', name: 'amount_remaining'},
            {data: 'status', name: 'status'},
            {data: 'transaction_id', name: 'transaction_id'},
            // {data: 'action', searchable: false, orderable: false}
        ];

    </script>


@endsection

