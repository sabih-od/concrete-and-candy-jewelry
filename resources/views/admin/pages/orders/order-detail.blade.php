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
                                <h4 class="mt-0 header-title">Order Detail Listing</h4>
                            </div>
                            <table id="geniustable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Unit Price</th>
                                    <th>Sub Total</th>
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
        var indexRoute = '{{ route("my.order.details",['order' => $order->id , 'page' => 'admin']) }}';

        var moduleName = '{{ request()->segment(2) }}';

        var columnsConfig = [
            {data: 'order_id', name: 'order_id'},
            {data: 'product_id', name: 'product_id'},
            {data: 'quantity', name: 'quantity'},
            {data: 'size_id', name: 'size_id'},
            {data: 'color', name: 'color'},
            {data: 'unit_price', name: 'unit_price'},
            {data: 'subtotal', name: 'subtotal'},
        ];

    </script>


@endsection

