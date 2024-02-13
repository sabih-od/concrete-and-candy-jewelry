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
                                <h4 class="mt-0 header-title">Subscription Listing</h4>

                                <a href="{{ route('admin.subscription.create') }}">
                                    <button class="btn btn-dark">+ Add Subscription Package</button>
                                </a>
                            </div>
                            <table id="geniustable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Cost</th>
                                    <th>Product Limit</th>
                                    <th>Allowed Products</th>
                                    <th>Total Price</th>
                                    <th>Expiry Days</th>
                                    <th>Details</th>
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
        var indexRoute = '{{ route("admin.subscriptions.index") }}'; //for datatable.js

        var moduleName = '{{ request()->segment(2) }}'; //for main.js

        var columnsConfig = [
            { data: 'title', name: 'title' }, // Access the parent category
            { data: 'cost', name: 'cost' },
            { data: 'limitation', name: 'limitation' },
            { data: 'allowed_products', name: 'allowed_products' },
            { data: 'total_price', name: 'total_price' },
            { data: 'expiry_days', name: 'expiry_days' },
            { data: 'details', name: 'details' },
            // { data: 'created_at', name: 'created_at' },
            { data: 'action', searchable: false, orderable: false }
        ];
    </script>


@endsection
