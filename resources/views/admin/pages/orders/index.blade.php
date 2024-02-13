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
                                <h4 class="mt-0 header-title">Orders Listing</h4>
                            </div>
                            <table id="geniustable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Shipping Address</th>
                                    <th>Total Items</th>
                                    <th>Total Amount</th>
                                    <th>Discount</th>
                                    <th>Amount After Discount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
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
        var indexRoute = '{{ route("my.orders.index") }}';

        var moduleName = '{{ request()->segment(2) }}';

        var columnsConfig = [
            {data: 'user_id', name: 'user_id'},
            {data: 'shipping_address', name: 'shipping_address'},
            {data: 'total_items', name: 'total_items'},
            {data: 'total_price', name: 'total_price'},
            {data: 'discount', name: 'discount'},
            {data: 'total_amount_after_discount', name: 'total_amount_after_discount'},
            {data: 'status', name: 'status'},
            {data: 'transaction_id', name: 'transaction_id'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', searchable: false, orderable: false}
        ];

    </script>


@endsection

